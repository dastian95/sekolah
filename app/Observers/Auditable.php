<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;

trait Auditable
{
    public static function bootAuditable()
    {
        static::creating(function ($model) {
            if (Auth::guard('admin')->check()) {
                $model->created_by = Auth::guard('admin')->id();
            }
        });

        static::updating(function ($model) {
            if (Auth::guard('admin')->check()) {
                $model->updated_by = Auth::guard('admin')->id();
            }
        });
    }
}
