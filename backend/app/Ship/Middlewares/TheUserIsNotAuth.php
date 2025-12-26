<?php

namespace App\Ship\Middlewares;

use App\Ship\Core\Loaders\RoutesLoader;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class TheUserIsNotAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userIsAuth = Auth::check();
        if ($userIsAuth) {
            return Redirect::route(RoutesLoader::HOME);
        }
        return $next($request);
    }
}
