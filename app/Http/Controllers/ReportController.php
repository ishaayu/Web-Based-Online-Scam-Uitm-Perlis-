<?php

namespace App\Http\Controllers;

// Import the Base Controller explicitly (Fixes the fatal error)
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    // ... (rest of your code remains the same)
    // --- MAIN DASHBOARD REDIRECTOR ---
    public function dashboard()
    {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        
        // USER DASHBOARD LOGIC
        $user = auth()->user();
        
        // We use these specific names to match your View ($totalPending, etc.)
        $totalReports = $user->reports()->count();
        $totalPending = $user->reports()->where('status', 'Pending')->count(); 
        $totalSolved  = $user->reports()->where('status', 'Resolved')->count();
        
        return view('dashboard', compact('totalReports', 'totalPending', 'totalSolved'));
    }

    // --- USER FUNCTIONS ---
    
    public function index()
    {
        $myReports = auth()->user()->reports()->latest()->get();
        return view('reports.index', compact('myReports'));
    }

    public function create()
    {
        return view('reports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'report_type' => 'required',
            'description' => 'required',
            'evidence' => 'nullable|image|max:5000'
        ]);

        $path = $request->file('evidence') ? $request->file('evidence')->store('evidence', 'public') : null;

        Report::create([
            'user_id' => Auth::id(),
            'scam_type' => $request->report_type,
            'description' => $request->description,
            'evidence' => $path,
            'status' => 'Pending'
        ]);

        return redirect()->route('report.index')->with('success', 'Report submitted to Admin.');
    }

    // --- ADMIN FUNCTIONS ---

    public function adminDashboard()
    {
        // Admin sees EVERYTHING
        $reports = Report::with('user')->latest()->get();
        $totalUsers = User::where('role', 'user')->count();
        $pendingReports = Report::where('status', 'Pending')->count();
        
        return view('admin.dashboard', compact('reports', 'totalUsers', 'pendingReports'));
    }

    public function resolve($id)
    {
        $report = Report::findOrFail($id);
        $report->status = 'Resolved';
        $report->save();
        return back()->with('success', 'Case marked as Resolved.');
    }

    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        if($report->evidence) Storage::disk('public')->delete($report->evidence);
        $report->delete();
        return back()->with('success', 'Report deleted successfully.');
    }
}