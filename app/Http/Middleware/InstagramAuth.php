<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;

class InstagramAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param null $redirectToRoute
     * @return mixed
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        if (! $request->user()->instagramAccount) {
            return $request->expectsJson()
                ? abort(403, 'Your instagram account is not connected.')
                : Redirect::route($redirectToRoute ?: 'home');
        }

        return $next($request);
    }
}
