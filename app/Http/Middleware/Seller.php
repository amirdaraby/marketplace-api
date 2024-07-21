<?php

namespace App\Http\Middleware;

use App\Enums\RolesEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Seller
{
    public function __construct(private Admin $orAdmin)
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::user()->role->name !== RolesEnum::SELLER->value) {
            return $this->orAdmin->handle($request, $next);
        }

        return $next($request);
    }
}
