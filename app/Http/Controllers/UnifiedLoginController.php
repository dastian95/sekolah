<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UnifiedLoginController extends Controller
{
    /**
     * Show unified login form
     */
    public function showLoginForm()
    {
        return view('auth.unified-login');
    }

    /**
     * Handle login for both students and admins
     */
    public function login(Request $request)
    {
        $userType = $request->input('user_type'); // 'student' or 'admin'

        if ($userType === 'student') {
            return $this->loginStudent($request);
        } else {
            return $this->loginAdmin($request);
        }
    }

    /**
     * Login as student (NISN-based)
     */
    private function loginStudent(Request $request)
    {
        $request->validate([
            'login_id' => 'required|string',
            'password' => 'required|string|min:6',
        ], [
            'login_id.required' => 'NISN, Username, atau Email harus diisi',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        $loginId = $request->input('login_id');

        // Determine if input is NISN (10 digit number), email, or username
        if (preg_match('/^\d{10}$/', $loginId)) {
            $field = 'nisn';
        } elseif (filter_var($loginId, FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        } else {
            $field = 'username';
        }

        // Check if student exists
        $student = \App\Models\Student::where($field, $loginId)->first();

        if ($student && \Illuminate\Support\Facades\Hash::check($request->input('password'), $student->password)) {
            // Logout admin guard jika aktif
            Auth::guard('web')->logout();
            // Login student
            Auth::guard('students')->login($student);
            // Regenerate session for security
            $request->session()->regenerate();
            return redirect()->route('student.dashboard')
                ->with('success', 'Selamat datang, ' . $student->nama . '!');
        }

        return back()
            ->withInput()
            ->with('error', 'NISN/Username/Email atau password salah.');
    }

    /**
     * Login as admin (email/username-based)
     */
    private function loginAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string|min:6',
        ], [
            'email.required' => 'Email atau Username harus diisi',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        // Cek apakah input adalah email atau username
        $emailOrUsername = $request->input('email');
        $isEmail = filter_var($emailOrUsername, FILTER_VALIDATE_EMAIL);

        // Find user by email or username
        $user = \App\Models\User::where(
            $isEmail ? 'email' : 'name',
            $emailOrUsername
        )->first();

        if ($user && \Illuminate\Support\Facades\Hash::check($request->input('password'), $user->password)) {
            // Logout student guard jika aktif
            Auth::guard('students')->logout();
            // Login admin
            Auth::login($user);
            // Regenerate session for security
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')
                ->with('success', 'Selamat datang, ' . $user->name . '!');
        }

        return back()
            ->withInput()
            ->with('error', 'Email/Username atau password salah.');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        // Logout dari semua guard
        Auth::guard('web')->logout();
        Auth::guard('students')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('unified.login')
            ->with('success', 'Anda berhasil logout.');
    }
}
