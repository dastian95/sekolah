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

        if (!$student->canEditProfile()) {
            return redirect()->route('student.dashboard')
                ->with('error', 'Data tidak dapat diubah karena status pendaftaran Anda saat ini: ' . $student->status_label);
        }

        return view('student.profile-edit', compact('student'));
    }

    /**
     * Update the student's profile in the database.
     */
    public function updateProfile(Request $request)
    {
        $student = Auth::guard('students')->user();
        $student = Student::where('id_siswa', $student->id_siswa)->firstOrFail();

        if (!$student->canEditProfile()) {
            return redirect()->route('student.dashboard')
                ->with('error', 'Data tidak dapat diubah.');
        }

        $id = $student->id_siswa;

        $validated = $request->validate([
            'nama'            => 'required|string|max:255',
            'username'        => 'required|string|max:50|unique:students,username,' . $id . ',id_siswa',
            'email'           => 'required|email|max:255|unique:students,email,' . $id . ',id_siswa',
            'hp'              => 'required|string|max:20',
            'nisn'            => 'nullable|string|max:20|unique:students,nisn,' . $id . ',id_siswa',
            'nik'             => 'nullable|string|max:20|unique:students,nik,' . $id . ',id_siswa',
            'jenis_kelamin'   => 'required|in:L,P',
            'tempat_lahir'    => 'required|string|max:100',
            'tanggal_lahir'   => 'required|date',
            'agama'           => 'required|string|max:50',
            'anak_ke'         => 'nullable|integer|min:1',
            'status_keluarga' => 'nullable|string|max:50',
            'sekolah_asal'    => 'nullable|string|max:255',
            'alamat'          => 'required|string',
            'rt'              => 'nullable|string|max:10',
            'rw'              => 'nullable|string|max:10',
            'kelurahan'       => 'nullable|string|max:100',
            'kecamatan'       => 'nullable|string|max:100',
            'kabupaten'       => 'nullable|string|max:100',
            'provinsi'        => 'nullable|string|max:100',
            'kode_pos'        => 'nullable|string|max:10',
            'nama_ayah'       => 'required|string|max:255',
            'pekerjaan_ayah'  => 'nullable|string|max:100',
            'nohp_ayah'       => 'nullable|string|max:20',
            'nama_ibu'        => 'nullable|string|max:255',
            'pekerjaan_ibu'   => 'nullable|string|max:100',
            'nohp_ibu'        => 'nullable|string|max:20',
            'nama_wali'       => 'nullable|string|max:255',
            'nohp_wali'       => 'nullable|string|max:20',
        ]);

        $student->update($validated);

        return redirect()->route('student.profile')
            ->with('success', 'Data berhasil diperbarui!');
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
        $student = Student::findOrFail($user->getKey());

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
