<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class DeleteThreadAndMessage
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
            if (Auth::guard('freshman')->user()->id == $request->freshman_id) {
                return $next($request);
            }
        }
        if (Auth::guard('circle')->check()) {
            if (Auth::guard('circle')->user()->id == $request->id) {
                return $next($request);
            }
        }
        return redirect(RouteServiceProvider::TOP);
    }
}
