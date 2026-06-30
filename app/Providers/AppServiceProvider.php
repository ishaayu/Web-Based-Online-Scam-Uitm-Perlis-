<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            return;
        }

        $request = request();

        if (str_contains($request->headers->get('X-Forwarded-Proto') ?? '', 'https') || $request->secure()) {
            URL::forceScheme('https');
        }

        if (str_contains($request->getHost(), 'ngrok')) {
            URL::forceRootUrl('https://'.$request->getHost());
        }
    }
}