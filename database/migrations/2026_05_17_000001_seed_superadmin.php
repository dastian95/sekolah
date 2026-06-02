<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\User;

return new class extends Migration
{
    public function up(): void
    {
        $email    = env('SUPERADMIN_EMAIL');
        $password = env('SUPERADMIN_PASSWORD');
        $name     = env('SUPERADMIN_NAME', 'superadmin');

        if ($email && $password) {
            User::updateOrCreate(
                ['email' => $email],
                ['name' => $name, 'password' => $password]
            );
        }
    }

    public function down(): void
    {
        $email = env('SUPERADMIN_EMAIL');
        if ($email) {
            User::where('email', $email)->delete();
        }
    }
};
