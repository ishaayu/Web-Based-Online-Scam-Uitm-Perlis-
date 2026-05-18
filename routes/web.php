<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

// 1. PUBLIC ROUTE - Move this OUTSIDE the middleware
// Removed the redirect and pointed it to the welcome view
Route::get('/', function () { 
    return view('welcome'); 
});

// 2. PROTECTED ROUTES - Only for logged-in users
Route::middleware(['auth'])->group(function () {
    
    // Shared Dashboard Link
    Route::get('/dashboard', [ReportController::class, 'dashboard'])->name('dashboard');

    // --- USER ROUTES ---
    Route::get('/my-reports', [ReportController::class, 'index'])->name('report.index');
    Route::get('/report/new', [ReportController::class, 'create'])->name('report.create');
    Route::post('/report/store', [ReportController::class, 'store'])->name('report.store');

    // --- ADMIN ROUTES (Protected) ---
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/dashboard', [ReportController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::patch('/admin/report/{id}/resolve', [ReportController::class, 'resolve'])->name('admin.resolve');
        Route::delete('/admin/report/{id}/delete', [ReportController::class, 'destroy'])->name('admin.delete');
    });
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';