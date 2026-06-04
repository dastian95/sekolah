<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\SiteSetting;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        try {
            View::share('socialSettings', SiteSetting::getGroup('social'));
        } catch (\Exception $e) {
            View::share('socialSettings', []);
        }
    }
}
