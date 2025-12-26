<?php

namespace App\Ship\Middlewares;

use App\Ship\Core\Loaders\RoutesLoader;
use Closure;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        /** @phpstan-var string[] $guards */
        $guards = empty($guards) ? [null] : $guards;

        if (array_any($guards, fn($guard) => Auth::guard($guard)->check())) {
            return redirect(RoutesLoader::HOME);
        }

        return $next($request);
    }
}
