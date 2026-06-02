<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\User;

return new class extends Migration
{
    public function up(): void
    {
        $admins = [
            [
                'name'     => env('ADMIN1_NAME'),
                'email'    => env('ADMIN1_EMAIL'),
                'password' => env('ADMIN1_PASSWORD'),
            ],
            [
                'name'     => env('ADMIN2_NAME'),
                'email'    => env('ADMIN2_EMAIL'),
                'password' => env('ADMIN2_PASSWORD'),
            ],
            [
                'name'     => env('ADMIN3_NAME'),
                'email'    => env('ADMIN3_EMAIL'),
                'password' => env('ADMIN3_PASSWORD'),
            ],
        ];

        foreach ($admins as $admin) {
            if ($admin['email'] && $admin['password']) {
                User::updateOrCreate(
                    ['email' => $admin['email']],
                    ['name' => $admin['name'], 'password' => $admin['password']]
                );
            }
        }
    }

    public function down(): void
    {
        $emails = array_filter([
            env('ADMIN1_EMAIL'),
            env('ADMIN2_EMAIL'),
            env('ADMIN3_EMAIL'),
        ]);

        User::whereIn('email', $emails)->delete();
    }
};
