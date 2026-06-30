<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\CaseSolvedNotification; // Menyertakan kelas Notifikasi Emel
use Barryvdh\DomPDF\Facade\Pdf;               // Menyertakan pakej Penjana PDF
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    // ==========================================
    // SECURITY HELPER (Private function)
    // ==========================================
    
    private function isAdminCheck()
    {
        $user = Auth::user();
        // Checks if they are an admin based on 'is_admin' or 'role' column
        return (isset($user->is_admin) && $user->is_admin == 1) || 
               (isset($user->role) && $user->role === 'admin');
    }

    // ==========================================
    // STUDENT METHODS (No admin check needed)
    // ==========================================

    /**
     * Display the Student Dashboard with statistics.
     */
    public function dashboard()
    {
        $userId = Auth::id();

        // 1. Fetch case counters metrics for the logged-in student
        $totalCases = Report::where('user_id', $userId)->count();
        $totalPending = Report::where('user_id', $userId)->where('status', 'Pending')->count();
        $totalResolved = Report::where('user_id', $userId)->where('status', 'Resolved')->count();

        // 2. Fetch breakdown distribution of scam categories for charts/lists
        $scamStats = Report::where('user_id', $userId)
            ->selectRaw('scam_type, count(*) as total')
            ->groupBy('scam_type')
            ->pluck('total', 'scam_type')
            ->toArray();

        // Pass all variables seamlessly to resources/views/dashboard.blade.php
        return view('dashboard', compact('totalCases', 'totalPending', 'totalResolved', 'scamStats'));
    }

    public function index()
    {
        $reports = Report::where('user_id', Auth::id())->latest()->get();
        return view('report.index', compact('reports'));
    }

    public function create()
    {
        return view('report.create');
    }

    public function store(Request $request)
    {
        // 1. Validate the incoming form data
        $request->validate([
        'scam_type' => 'required',
        // 'min:2048' forces the file to be AT LEAST 2MB or larger to pass
        'evidence'  => 'required|file|mimes:jpg,png,pdf|min:2048', 
        ], [
        // Custom error messages
        'evidence.required' => 'The evidence document/image is mandatory.',
        'evidence.min'      => 'Upload failed! The evidence file must be larger than 2MB to ensure high resolution for our investigation.',
        'evidence.mimes'    => 'The evidence must be a file of type: JPG, PNG, or PDF.',
        ]);

        // 2. Create and save the new report to the database
        $report = new Report();
        $report->user_id = Auth::id();
        $report->scam_type = $request->scam_type;
        $report->description = $request->description;
        $report->status = 'Pending'; // Default status for new cases
        $report->save();

        // 3. Redirect the user back to their dashboard with a success message
        return redirect()->route('dashboard')->with('success', 'Your report has been submitted successfully and is now Pending.');
    }

    // Displays the individual report document for the Student
    public function generate($id)
    {
        $report = Report::where('user_id', Auth::id())->findOrFail($id);
        
        // This links to the printable blade file we created
        return view('admin.report-details', compact('report'));
    }

    public function markNotificationsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return back();
    }


    // ==========================================
    // ADMIN METHODS (Secured with 403 Abort)
    // ==========================================

    public function adminDashboard()
{
    if (!$this->isAdminCheck()) {
        abort(403, 'UNAUTHORIZED');
    }

    $totalUsers = User::count();
    $totalCases = Report::count();
    $pendingReports = Report::where('status', 'Pending')->count();
    $resolvedReports = Report::where('status', 'Resolved')->count();
    $reports = Report::latest()->get(); 

    // 📊 KOD DIKEMASKINI: Ambil pecahan jenis scam mengikut bulan (Tahun Semasa)
    $currentYear = date('Y');
    
    // 1. Ambil senarai jenis scam yang unik dalam database untuk dijadikan Label Kumpulan
    $scamTypes = Report::distinct()->pluck('scam_type')->toArray();
    if(empty($scamTypes)) {
        $scamTypes = ['General Scam']; // Backup jika database kosong
    }

    // 2. Tarik data mentah gabungan Bulan + Jenis Scam dari SQLite
    $rawMonthlyScams = Report::whereRaw("strftime('%Y', created_at) = ?", [$currentYear])
        ->selectRaw("strftime('%m', created_at) as month, scam_type, count(*) as total")
        ->groupBy('month', 'scam_type')
        ->get();

    // 3. Susun struktur data (Matrix) 12 Bulan untuk setiap Jenis Scam
    $scamDatasets = [];
    
    // Sediakan warna rawak/standard untuk setiap jenis scam supaya graf cantik
    $colors = ['#7c3aed', '#10b981', '#f59e0b', '#ef4444', '#3b82f6', '#ec4899', '#6b7280'];
    
    foreach ($scamTypes as $index => $type) {
        $monthlyCounts = [];
        
        for ($m = 1; $m <= 12; $m++) {
            $monthKey = sprintf('%02d', $m);
            
            // Cari data match bagi bulan $monthKey dan jenis scam $type
            $match = $rawMonthlyScams->where('month', $monthKey)->where('scam_type', $type)->first();
            $monthlyCounts[] = $match ? $match->total : 0;
        }

        $color = $colors[$index % count($colors)];

        $scamDatasets[] = [
            'label' => $type,
            'data' => $monthlyCounts,
            'backgroundColor' => $color,
            'hoverBackgroundColor' => $color,
        ];
    }

    // Hantar data baharu ke view admin dashboard
    return view('admin.dashboard', compact(
        'reports', 
        'totalUsers', 
        'totalCases', 
        'pendingReports', 
        'resolvedReports',
        'scamDatasets' // Variabel baharu menggantikan chartData lama
    ));
}

    /**
     * 🛠️ DIKEMASKINI: Menukar status dan menghantar notifikasi emel kepada pelajar.
     */
    public function resolve($id)
    {
        // 1. Security Gatekeeper
        if (!$this->isAdminCheck()) {
            abort(403, 'UNAUTHORIZED');
        }

        // 2. Cari aduan bersama maklumat pelajar (user) sekali gus
        $report = Report::with('user')->findOrFail($id);
        
        // 3. Kemaskini status mengikut standard database anda ('Resolved')
        $report->update(['status' => 'Resolved']);

        // 4. Proses penghantaran Emel Notifikasi
        $student = $report->user;
        if ($student && !empty($student->email)) {
            try {
                $student->notify(new CaseSolvedNotification($report));
            } catch (\Exception $e) {
                // Rekod ralat dalam log sekiranya SMTP gagal, tetapi sistem tidak akan crash
                Log::error('Ralat Penghantaran Emel: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Case resolved successfully and student has been notified via email.');
    }

    // Displays the Master Summary Report for the Admin Sidebar
    public function adminSummary()
    {
        if (!$this->isAdminCheck()) {
            abort(403, 'UNAUTHORIZED');
        }

        // Gather master statistics
        $totalCases = Report::count();
        $pendingCases = Report::where('status', 'Pending')->count();
        $resolvedCases = Report::where('status', 'Resolved')->count();
        $reports = Report::with('user')->latest()->get();

        // Links to the summary.blade.php master document
        return view('admin.summary', compact('totalCases', 'pendingCases', 'resolvedCases', 'reports')); 
    }

    // Displays the individual report document for the Admin Table
    public function generateSummary($id)
    {
        if (!$this->isAdminCheck()) {
            abort(403, 'UNAUTHORIZED');
        }

        $report = Report::with('user')->findOrFail($id);
        
        // Links to the report-details.blade.php printable file
        return view('admin.report-details', compact('report')); 
    }

    /**
     * 🛠️ DITAMBAH: Membolehkan pelajar memuat turun ringkasan PDF aduan daripada pautan emel.
     */
    public function downloadSummary($id)
    {
        // Memastikan hanya pemilik aduan atau admin sahaja boleh download fail ini
        $report = Report::with('user')->findOrFail($id);
        
        if (Auth::id() !== $report->user_id && !$this->isAdminCheck()) {
            abort(403, 'UNAUTHORIZED');
        }

        // Load halaman blade khusus untuk template PDF ringkasan kes
        $pdf = Pdf::loadView('reports.summary', compact('report'));

        return $pdf->download('Polis_Bantuan_Kes_#' . $report->id . '.pdf');
    }

    public function destroy($id)
    {
        // 1. Security Gatekeeper
        if (!$this->isAdminCheck()) {
            abort(403, 'UNAUTHORIZED');
        }

        // 2. Delete Logic
        $report = Report::findOrFail($id);
        $report->delete();
        return back()->with('success', 'Case deleted securely.');
    }
}