<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationCredentialsMail;
use App\Models\SiteSetting;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PendaftaranController extends Controller
{
    /**
     * Show the registration form.
     */
    public function create()
    {
        if (!SiteSetting::isRegistrationOpen()) {
            return view('pendaftaran', [
                'registrationClosed' => true,
                'closedMessage' => SiteSetting::getRegistrationClosedMessage(),
            ]);
        }

        return view('pendaftaran', ['registrationClosed' => false]);
    }

    /**
     * Store a new student registration.
     */
    public function store(Request $request)
    {
        if (!SiteSetting::isRegistrationOpen()) {
            return redirect()->route('pendaftaran')
                ->with('error', SiteSetting::getRegistrationClosedMessage());
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'agama' => 'required|string|max:50',
            'origin_school' => 'nullable|string|max:255',
            'parent_name' => 'required|string|max:255',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'pendidikan_ayah' => 'nullable|string|max:255',
            'whatsapp_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'provinsi' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kelurahan' => 'nullable|string|max:255',
            'address_short' => 'nullable|string|max:500',
        ]);

        // Generate plain password before hashing
        $year = now()->year;
        $plainPassword = 'labitech' . $year;

        // Transaction to ensure registration number is unique and sequential
        $student = DB::transaction(function () use ($validated, $plainPassword, $year) {
            // Generate Registration Number: REG-YYYY-XXX (e.g., REG-2026-001)
            $latestStudent = Student::whereYear('created_at', $year)
                ->whereNotNull('registration_number')
                ->orderByDesc('id_siswa')
                ->first();
            $nextId = $latestStudent 
                ? ((int) substr($latestStudent->registration_number, -3)) + 1 
                : 1;
            $registrationNumber = 'REG-' . $year . '-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

            // Generate NIS: PPDB-YYYY-XXX
            $nis = 'PPDB-' . $year . '-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

            // Generate username from name (lowercase, no spaces + random suffix)
            $baseName = Str::slug($validated['full_name'], '');
            $username = $baseName . $nextId;

            // Generate UID
            $uid = 'STD-' . strtoupper(Str::random(8));

            // Map form fields to database columns
            return Student::create([
                'nama'                => $validated['full_name'],
                'jenis_kelamin'       => $validated['gender'],
                'tempat_lahir'        => $validated['birth_place'],
                'tanggal_lahir'       => $validated['birth_date'],
                'sekolah_asal'        => $validated['origin_school'],
                'nama_ayah'           => $validated['parent_name'],
                'nohp_ayah'           => $validated['whatsapp_number'],
                'hp'                  => $validated['whatsapp_number'],
                'email'               => $validated['email'],
                'alamat'              => $validated['address_short'],
                'registration_number' => $registrationNumber,
                'nis'                 => $nis,
                'username'            => $username,
                'password'            => Hash::make($plainPassword),
                'uid'                 => $uid,
                'status'              => 'pending',
            ]);
        });

        // Send email with account credentials
        try {
            Mail::to($validated['email'])->queue(
                new RegistrationCredentialsMail(
                    studentName: $student->nama,
                    registrationNumber: $student->registration_number,
                    username: $student->username,
                    plainPassword: $plainPassword
                )
            );
        } catch (\Exception $e) {
            Log::error('Failed to queue registration email: ' . $e->getMessage());
            // Registration still succeeds even if email fails
        }

        return redirect()->route('pendaftaran')
            ->with('success', 'Pendaftaran berhasil! Nomor registrasi Anda: ' . $student->registration_number . '. Informasi akun telah dikirim ke email ' . $validated['email'] . '. Silakan cek inbox atau folder spam Anda.');
    }
}