<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $settings = [
            ['key' => 'registration_open',           'value' => '1',    'group' => 'registration'],
            ['key' => 'registration_start_date',      'value' => null,   'group' => 'registration'],
            ['key' => 'registration_end_date',        'value' => null,   'group' => 'registration'],
            ['key' => 'registration_capacity',        'value' => '100',  'group' => 'registration'],
            ['key' => 'registration_closed_message',  'value' => 'Pendaftaran peserta didik baru saat ini sedang ditutup. Silakan kunjungi kembali pada periode pendaftaran berikutnya atau hubungi pihak sekolah untuk informasi lebih lanjut.', 'group' => 'registration'],
        ];

        foreach ($settings as $setting) {
            DB::table('site_settings')->updateOrInsert(
                ['key' => $setting['key']],
                array_merge($setting, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }

    public function down(): void
    {
        DB::table('site_settings')
            ->where('group', 'registration')
            ->delete();
    }
};
