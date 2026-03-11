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
