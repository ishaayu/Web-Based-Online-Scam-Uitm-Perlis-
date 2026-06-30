<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // 1. Get the authenticated user
        $user = Auth::user();

        // 2. Dynamic Role-Based Redirection
        // Check if your users table uses an 'is_admin' boolean column
        if (isset($user->is_admin) && $user->is_admin == 1) {
            return redirect()->route('admin.dashboard'); // Redirect to Admin Panel
        }

        // OR check if your users table uses a string 'role' column (e.g., 'admin' vs 'student')
        if (isset($user->role) && $user->role === 'admin') {
            return redirect()->route('admin.dashboard'); // Redirect to Admin Panel
        }

        // 3. Default redirect for regular UiTM Student Users
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}