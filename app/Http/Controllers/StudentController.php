<?php

namespace App\Http\Controllers;

use App\Models\Student;
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
     * Show the form for editing the student's profile.
     */
    public function editProfile()
    {
        $student = Auth::guard('students')->user();
        $restrictedStatuses = ['Sudah Dihubungi', 'tidak lulus', 'lulus'];

        if (in_array($student->status, $restrictedStatuses)) {
            return redirect()->route('student.dashboard')->with('error', 'Profil tidak dapat diubah karena status Anda saat ini.');
        }

        return view('student.profile-edit', compact('student'));
    }

    /**
     * Update the student's profile in the database.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::guard('students')->user();
        $student = Student::findOrFail($user->id);
        $restrictedStatuses = ['Sudah Dihubungi', 'tidak lulus', 'lulus'];

        if (in_array($student->status, $restrictedStatuses)) {
            return redirect()->route('student.dashboard')->with('error', 'Profil tidak dapat diubah.');
        }

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:students,username,' . $student->id,
            'email' => 'required|email|max:255|unique:students,email,' . $student->id,
            'telepon' => 'required|string|max:20',
            'nisn' => 'required|string|max:20|unique:students,nisn,' . $student->id,
            'nik' => 'required|string|max:20|unique:students,nik,' . $student->id,
            'no_kk' => 'required|string|max:30',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:50',
            'anak_ke' => 'nullable|integer|min:1',
            'jumlah_saudara' => 'nullable|integer|min:0',
            'tinggal_bersama' => 'nullable|string|max:100',
            'alamat' => 'required|string',
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan_ayah' => 'nullable|string|max:100',
            'penghasilan_ayah' => 'nullable|string|max:100',
            'hp_ayah' => 'nullable|string|max:20',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'nullable|string|max:100',
            'penghasilan_ibu' => 'nullable|string|max:100',
            'hp_ibu' => 'nullable|string|max:20',
        ]);

        $student->update($validated);

        return redirect()->route('student.dashboard')->with('success', 'Profil berhasil diperbarui!');
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

        $user = Auth::guard('students')->user();
        $student = Student::findOrFail($user->id);

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
