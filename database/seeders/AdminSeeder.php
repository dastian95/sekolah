<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            [
                'name' => 'labitech', // Username admin utama
                'email' => 'admin@labitech.sch.id',
                'password' => 'secret123',
            ],
            [
                'name' => 'kepalasekolah',
                'email' => 'kepsek@labitech.sch.id',
                'password' => 'labitech2026',
            ],
            [
                'name' => 'tatausaha',
                'email' => 'tu@labitech.sch.id',
                'password' => 'admin12345',
            ],
        ];

        foreach ($admins as $admin) {
            User::updateOrCreate(
                ['email' => $admin['email']],
                [
                    'name' => $admin['name'],
                    'password' => $admin['password'],
                ]
            );
        }
    }
}