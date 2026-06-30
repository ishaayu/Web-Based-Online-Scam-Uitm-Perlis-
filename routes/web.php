<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Models\Report; 

// 1. PUBLIC ROUTE WITH REAL LIVE STATS
Route::get('/', function () { 
    $totalCases = Report::count();
    $resolvedCases = Report::where('status', 'Resolved')->count();
    $actionRate = $totalCases > 0 ? round(($resolvedCases / $totalCases) * 100) : 100;

    $scamStats = Report::selectRaw('scam_type, count(*) as total')
        ->groupBy('scam_type')
        ->pluck('total', 'scam_type')
        ->toArray();

    return view('welcome', compact('resolvedCases', 'actionRate', 'scamStats')); 
});

Route::middleware(['auth'])->group(function () {
    // User Dashboard & Reports
    Route::get('/dashboard', [ReportController::class, 'dashboard'])->name('dashboard');
    Route::get('/my-reports', [ReportController::class, 'index'])->name('report.index');
    Route::get('/report/new', [ReportController::class, 'create'])->name('report.create');
    Route::post('/report/store', [ReportController::class, 'store'])->name('report.store');
    Route::get('/report/{id}/generate', [ReportController::class, 'generate'])->name('report.generate');
    Route::get('/report/summary/{id}', [ReportController::class, 'downloadSummary'])->name('report.summary');

    // Notifications
    Route::post('/notifications/read', [ReportController::class, 'markNotificationsRead'])->name('notifications.read');

    // Admin Routes (Secured directly inside the controller now)
    Route::get('/admin/dashboard', [ReportController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/summary', [ReportController::class, 'adminSummary'])->name('admin.summary');
    Route::patch('/admin/report/{id}/resolve', [ReportController::class, 'resolve'])->name('admin.resolve');
    Route::delete('/admin/report/{id}/delete', [ReportController::class, 'destroy'])->name('admin.delete');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/admin-summary/report/{id}', [App\Http\Controllers\ReportController::class, 'generateSummary'])->middleware('auth');
    Route::post('/admin/report/{id}/solve', [ReportController::class, 'solveCase'])->name('admin.report.solve');
    Route::get('/report/summary/{id}', [ReportController::class, 'downloadSummary'])->name('report.summary');
});

require __DIR__.'/auth.php';

