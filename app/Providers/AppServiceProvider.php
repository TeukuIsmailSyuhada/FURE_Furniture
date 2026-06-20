<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;

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
     * - Gunakan custom pagination view agar tampilan konsisten dengan Bootstrap.
     * - Paksa HTTPS jika request lewat proxy (Cloudflare / AWS).
     *
     * @return void
     */
    public function boot()
    {
        // Gunakan custom pagination view yang sesuai desain FURE
        Paginator::defaultView('pagination.fure');

        // Deteksi HTTPS via Cloudflare Tunnel / Proxy
        if (request()->header('X-Forwarded-Proto') === 'https' || request()->secure()) {
            URL::forceScheme('https');
        }
    }
}
