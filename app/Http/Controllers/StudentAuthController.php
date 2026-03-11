<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentAuthController extends Controller
{
    /**
     * Show student login form
     */
    public function showLoginForm()
    {
        if (Auth::guard('students')->check()) {
            return redirect()->route('student.dashboard');
        }
        return view('student.auth.login');
    }

    /**
     * Show student registration form
     */
    public function showRegisterForm()
    {
        return view('student.auth.register');
    }

    /**
     * Handle student login
     */
    public function login(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string|size:10',
            'password' => 'required|string|min:6',
        ], [
            'nisn.required' => 'NISN harus diisi.',
            'nisn.size' => 'NISN harus 10 digit.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        $nisn = $request->input('nisn');
        $password = $request->input('password');

        // Cari student berdasarkan NISN
        $student = Student::where('nisn', $nisn)->first();

        // Verifikasi password
        if ($student && Hash::check($password, $student->password)) {
            Auth::guard('students')->login($student, $request->boolean('remember'));
            $request->session()->regenerate();
            return redirect()->intended(route('student.dashboard'));
        }

        // Login gagal
        return back()->withErrors([
            'nisn' => 'NISN atau Password tidak sesuai.',
        ])->onlyInput('nisn');
    }

    /**
     * Handle student registration
     */
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'nisn' => 'required|string|size:10|unique:students,nisn',
            'nis' => 'nullable|string|unique:students,nis',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date|before:2020-01-01',
            'hp' => 'required|string|regex:/^08[0-9]{8,11}$/',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'nama.required' => 'Nama lengkap harus diisi.',
            'nisn.required' => 'NISN harus diisi.',
            'nisn.size' => 'NISN harus tepat 10 digit.',
            'nisn.unique' => 'NISN sudah terdaftar.',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
            'tempat_lahir.required' => 'Tempat lahir harus diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
            'hp.required' => 'Nomor HP harus diisi.',
            'hp.regex' => 'Format nomor HP harus valid (08xxxxxxxxxx).',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        // Generate username dari nama
        $username = $this->generateUsername($request->input('nama'));

        // Buat student account
        $student = Student::create([
            'nisn' => $request->input('nisn'),
            'nis' => $request->input('nis'),
            'nama' => $request->input('nama'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'hp' => $request->input('hp'),
            'email' => $request->input('email'),
            'username' => $username,
            'password' => Hash::make($request->input('password')),
            'uid' => Str::uuid(),
            'status' => 'pending',
        ]);

        // Auto-login setelah registrasi
        Auth::guard('students')->login($student);

        return redirect()->route('student.dashboard')->with('success', 'Registrasi berhasil! Selamat datang!');
    }

    /**
     * Handle student logout
     */
    public function logout(Request $request)
    {
        Auth::guard('students')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('unified.login')->with('success', 'Anda telah logout.');
    }

    /**
     * Generate unique username from name
     */
    private function generateUsername($nama)
    {
        $baseUsername = Str::slug(str_replace(' ', '', $nama), '');
        $username = $baseUsername;
        $counter = 1;

        while (Student::where('username', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        return $username;
    }
}
