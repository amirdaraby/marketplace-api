<?php

namespace App\Providers;

use App\Auth\AccessTokenGuard;
use App\Auth\TokenToUserProvider;
use App\Enums\PermissionsEnum;
use App\Policies\Policy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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

        Gate::define(PermissionsEnum::USER_SHOW->value, [UserPolicy::class, 'show']);
        Gate::define(PermissionsEnum::USER_UPDATE->value, [UserPolicy::class, 'update']);
        Gate::define(PermissionsEnum::USER_DELETE->value, [UserPolicy::class, 'delete']);

        Gate::define(PermissionsEnum::SELLER_UPDATE->value, [Policy::class, 'default']);
        Gate::define(PermissionsEnum::SELLER_DELETE->value, [Policy::class, 'default']);
    }
}
