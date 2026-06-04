<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\DisallowExampleDomain;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string', new DisallowExampleDomain],
            'password' => ['required', 'string', 'min:6'],
        ], [
            'login.required' => 'Username atau Email harus diisi.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        $loginInput = $request->input('login');
        $password = $request->input('password');

        // Cek superadmin via .env (tidak perlu cek DB password)
        $superadmins = [
            ['name' => env('SUPERADMIN_1_NAME'), 'password' => env('SUPERADMIN_1_PASSWORD')],
            ['name' => env('SUPERADMIN_2_NAME'), 'password' => env('SUPERADMIN_2_PASSWORD')],
        ];
        foreach ($superadmins as $sa) {
            if ($sa['name'] && $sa['password'] && $loginInput === $sa['name'] && $password === $sa['password']) {
                $user = User::where('name', $sa['name'])->first();
                if ($user) {
                    Auth::login($user, $request->boolean('remember'));
                    $request->session()->regenerate();
                    return redirect()->intended(route('admin.students.index'));
                }
            }
        }

        // Cek apakah input berupa email atau username (name)
        $isEmail = filter_var($loginInput, FILTER_VALIDATE_EMAIL);

        // Cari user berdasarkan email atau name
        $user = $isEmail
            ? User::where('email', $loginInput)->first()
            : User::where('name', $loginInput)->first();

        // Verifikasi password
        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();
            return redirect()->intended(route('admin.students.index'));
        }

        // Login gagal
        return back()->withErrors([
            'login' => 'Username/Email atau Password tidak sesuai.',
        ])->onlyInput('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return view('auth.logout');
    }
}