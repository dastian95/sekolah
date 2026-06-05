<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperAdminUserController extends Controller
{
    public function index()
    {
        $users = User::orderByRaw("FIELD(role, 'superadmin', 'admin')")->orderBy('name')->get();
        return view('admin.superadmin.users', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255|unique:users,name',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:admin,superadmin',
        ], [
            'name.unique'  => 'Username sudah digunakan.',
            'email.unique' => 'Email sudah digunakan.',
        ]);

        // Hanya primary superadmin yang bisa tambah superadmin
        if ($request->role === 'superadmin' && !auth()->user()->isPrimarySuperadmin()) {
            return back()->withErrors(['role' => 'Hanya Superadmin Utama yang bisa menambah superadmin.']);
        }

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => $request->role,
            'is_active' => true,
        ]);

        return back()->with('success', 'Akun berhasil ditambahkan.');
    }

    public function toggleActive(User $user)
    {
        // Tidak bisa nonaktifkan diri sendiri
        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'Tidak bisa menonaktifkan akun sendiri.']);
        }

        // Hanya primary superadmin yang bisa nonaktifkan superadmin lain
        if ($user->isSuperadmin() && !auth()->user()->isPrimarySuperadmin()) {
            return back()->withErrors(['error' => 'Hanya Superadmin Utama yang bisa menonaktifkan superadmin.']);
        }

        $user->update(['is_active' => !$user->is_active]);
        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return back()->with('success', "Akun {$user->name} berhasil {$status}.");
    }

    public function resetPassword(Request $request, User $user)
    {
        $request->validate(['new_password' => 'required|string|min:6']);

        // Hanya primary superadmin yang bisa reset password superadmin lain
        if ($user->isSuperadmin() && !auth()->user()->isPrimarySuperadmin()) {
            return back()->withErrors(['error' => 'Hanya Superadmin Utama yang bisa reset password superadmin.']);
        }

        $user->update(['password' => Hash::make($request->new_password)]);

        return back()->with('success', "Password {$user->name} berhasil direset.");
    }

    public function destroy(User $user)
    {
        // Tidak bisa hapus diri sendiri
        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'Tidak bisa menghapus akun sendiri.']);
        }

        // Hanya primary superadmin yang bisa hapus superadmin lain
        if ($user->isSuperadmin() && !auth()->user()->isPrimarySuperadmin()) {
            return back()->withErrors(['error' => 'Hanya Superadmin Utama yang bisa menghapus superadmin.']);
        }

        $user->delete();
        return back()->with('success', "Akun {$user->name} berhasil dihapus.");
    }
}
