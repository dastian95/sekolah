<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;

trait Auditable
{
    public static function bootAuditable()
    {
        static::creating(function ($model) {
            if (Auth::guard('web')->check()) {
                $model->created_by = Auth::guard('web')->id();
            }
        });

        static::updating(function ($model) {
            if (Auth::guard('web')->check()) {
                $model->updated_by = Auth::guard('web')->id();
            }
        });
    }
}
