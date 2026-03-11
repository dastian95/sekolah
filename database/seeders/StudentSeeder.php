<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            [
                'nisn'                => '1234567890',
                'nis'                 => 'NIS-2026-001',
                'nama'                => 'Ahmad Fauzi',
                'jenis_kelamin'       => 'L',
                'username'            => 'ahmadfauzi',
                'password'            => Hash::make('siswa123'),
                'uid'                 => 'STD-AHMAD001',
                'tempat_lahir'        => 'Bekasi',
                'tanggal_lahir'       => '2015-05-10',
                'agama'               => 'Islam',
                'hp'                  => '081234567890',
                'email'               => 'ahmad@siswa.labitech.sch.id',
                'kelas_awal'          => 1,
                'tahun_masuk'         => '2021',
                'nama_ayah'           => 'Budi Fauzi',
                'nohp_ayah'           => '081298765432',
                'registration_number' => 'REG-2026-100',
                'status'              => 'verified',
            ],
            [
                'nisn'                => '0987654321',
                'nis'                 => 'NIS-2026-002',
                'nama'                => 'Siti Nurhaliza',
                'jenis_kelamin'       => 'P',
                'username'            => 'sitinurhaliza',
                'password'            => Hash::make('siswa123'),
                'uid'                 => 'STD-SITI0002',
                'tempat_lahir'        => 'Jakarta',
                'tanggal_lahir'       => '2015-08-22',
                'agama'               => 'Islam',
                'hp'                  => '081345678901',
                'email'               => 'siti@siswa.labitech.sch.id',
                'kelas_awal'          => 1,
                'tahun_masuk'         => '2021',
                'nama_ibu'            => 'Dewi Sartika',
                'nohp_ibu'            => '081356789012',
                'registration_number' => 'REG-2026-101',
                'status'              => 'verified',
            ],
        ];

        foreach ($students as $student) {
            Student::updateOrCreate(
                ['username' => $student['username']],
                $student
            );
        }
    }
}
