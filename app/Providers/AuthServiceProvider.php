<?php

namespace App\Providers;

use App\Auth\AccessTokenGuard;
use App\Auth\TokenToUserProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Auth::extend('api_token', function ($app, $name, array $config) {
            $provider = app(TokenToUserProvider::class);
            $request = app('request');

            return new AccessTokenGuard($provider, $request, $config);
        });
    }
}
