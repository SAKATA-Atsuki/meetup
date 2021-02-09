<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class CreateThreadAndMessage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('freshman')->check()) {
            return $next($request);
        }
        if (Auth::guard('circle')->check()) {
            if (Auth::guard('circle')->user()->id == $request->id) {
                return $next($request);
            }
        }
        return redirect(RouteServiceProvider::TOP);
    }
}
