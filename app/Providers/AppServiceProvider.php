<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Cek jika lingkungan aplikasi adalah produksi
        if (env('APP_ENV') == 'production') {
            // Memaksa penggunaan HTTPS pada semua URL
            URL::forceScheme('https');
        }
    }
}
