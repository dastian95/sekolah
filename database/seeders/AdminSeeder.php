<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus semua akun admin lama
        User::truncate();

        $admins = [
            [
                'name'     => 'lt.admin',
                'email'    => 'admin@labitech.sch.id',
                'password' => 'Labitech@2026!',
            ],
            [
                'name'     => 'lt.kepsek',
                'email'    => 'kepsek@labitech.sch.id',
                'password' => 'KepSek@2026!',
            ],
            [
                'name'     => 'lt.tatausaha',
                'email'    => 'tu@labitech.sch.id',
                'password' => 'TataUsaha@2026!',
            ],
        ];

        foreach ($admins as $admin) {
            User::create($admin);
        }
    }
}
