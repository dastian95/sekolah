<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Show student dashboard
     */
    public function dashboard()
    {
        $student = Auth::guard('students')->user();

        return view('student.dashboard', compact('student'));
    }

    /**
     * Show student personal info
     */
    public function profile()
    {
        $student = Auth::guard('students')->user();

        return view('student.profile', compact('student'));
    }

    /**
     * Show graduation status
     */
    public function graduationStatus()
    {
        $student = Auth::guard('students')->user();
        
        // Logika untuk mengambil status kelulusan
        // Bisa dari tabel terpisah atau field di students table
        $graduationInfo = [
            'status' => $student->status ?? 'pending',
            'tahun_lulus' => $student->tahun_masuk ? (int)$student->tahun_masuk + 6 : null,
            'nilai_akhir' => $student->nilai_akhir ?? '-',
            'keterangan' => $student->keterangan ?? 'Menunggu keputusan kelulusan',
        ];

        return view('student.graduation-status', compact('student', 'graduationInfo'));
    }

    /**
     * Download graduation certificate (jika sudah lulus)
     */
    public function downloadCertificate()
    {
        $student = Auth::guard('students')->user();

        if ($student->status !== 'verified') {
            return back()->with('error', 'Anda belum bisa download sertifikat kelulusan.');
        }

        // Generate PDF sertifikat
        // Implementasi akan ditambahkan nanti
        return back()->with('info', 'Fitur download sertifikat akan segera tersedia.');
    }

    /**
     * Show change password form
     */
    public function changePassword()
    {
        $student = Auth::guard('students')->user();
        return view('student.change-password', compact('student'));
    }

    /**
     * Update student password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'current_password.required' => 'Password lama harus diisi.',
            'password.required' => 'Password baru harus diisi.',
            'password.min' => 'Password baru minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        $student = Auth::guard('students')->user();

        if (!Hash::check($request->current_password, $student->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $student->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Password berhasil diubah!');
    }

    /**
     * Logout student
     */
    public function logout()
    {
        Auth::guard('students')->logout();
        session()->invalidate();
        session()->regenerateToken();
        
        return redirect()->route('unified.login')
            ->with('success', 'Anda berhasil logout.');
    }
}
