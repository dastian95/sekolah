<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus semua akun admin lama
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0');
        User::truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $admins = [
            ['name' => 'lt.admin',      'email' => 'admin@labitech.sch.id',              'password' => 'Labitech@2026!',              'role' => 'admin'],
            ['name' => 'lt.kepsek',     'email' => 'kepsek@labitech.sch.id',             'password' => 'KepSek@2026!',               'role' => 'admin'],
            ['name' => 'lt.tatausaha',  'email' => 'tu@labitech.sch.id',                 'password' => 'TataUsaha@2026!',             'role' => 'admin'],
            ['name' => 'AdminLab',      'email' => 'adminlab@labitech.sch.id',            'password' => 'sekolah@Labiteh!',            'role' => 'admin'],
            ['name' => 'ImamSekolah',   'email' => 'imam@labitech.sch.id',               'password' => 'imam#mahdi',                  'role' => 'admin'],
            // Superadmin — password DB random, login hanya via .env
            ['name' => 'Aufa',          'email' => 'aufa@superadmin.internal',            'password' => \Illuminate\Support\Str::random(64), 'role' => 'superadmin'],
            ['name' => 'SuperAdmin',    'email' => 'superadmin@superadmin.internal',      'password' => \Illuminate\Support\Str::random(64), 'role' => 'superadmin'],
        ];

        foreach ($admins as $admin) {
            User::create($admin);
        }
    }
}
