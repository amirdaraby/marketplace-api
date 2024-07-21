<?php

namespace App\Http\Middleware;

use App\Enums\RolesEnum;
use App\Exceptions\HttpAuthorizationException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->role->name !== RolesEnum::ADMIN->value) {
            throw new HttpAuthorizationException();
        }

        return $next($request);
    }
}
