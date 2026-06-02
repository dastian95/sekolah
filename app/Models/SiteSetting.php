<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value', 'group'];

    /**
     * Get a setting value by key, with optional default.
     */
    public static function getValue(string $key, ?string $default = null): ?string
    {
        return Cache::rememberForever("setting.{$key}", function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * Set a setting value by key.
     */
    public static function setValue(string $key, ?string $value, string $group = 'general'): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );

        // Forget cache on update
        Cache::forget("setting.{$key}");
        Cache::forget("setting.group.{$group}");
    }

    /**
     * Check if registration is currently open (toggle + period + capacity).
     */
    public static function isRegistrationOpen(): bool
    {
        // Manual toggle — if set to 0, always closed
        if ((string) static::getValue('registration_open', '1') === '0') {
            return false;
        }

        $now = now();

        // Period check
        $start = static::getValue('registration_start_date');
        $end   = static::getValue('registration_end_date');

        if ($start && $now->lt(\Carbon\Carbon::parse($start))) {
            return false;
        }
        if ($end && $now->gt(\Carbon\Carbon::parse($end))) {
            return false;
        }

        // Capacity check
        $capacity = (int) static::getValue('registration_capacity', '100');
        if ($capacity > 0 && \App\Models\Student::count() >= $capacity) {
            return false;
        }

        return true;
    }

    /**
     * Get registration closed message.
     */
    public static function getRegistrationClosedMessage(): string
    {
        return static::getValue(
            'registration_closed_message',
            'Pendaftaran peserta didik baru saat ini sedang ditutup. Silakan kunjungi kembali pada periode pendaftaran berikutnya atau hubungi pihak sekolah untuk informasi lebih lanjut.'
        );
    }

    /**
     * Get all settings for a group as key => value array.
     */
    public static function getGroup(string $group): array
    {
        return Cache::rememberForever("setting.group.{$group}", function () use ($group) {
            return static::where('group', $group)
                ->pluck('value', 'key')
                ->toArray();
        });
    }
}
