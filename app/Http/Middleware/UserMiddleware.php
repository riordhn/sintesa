<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('user')->check()) {
            $request->session()->put('auth_data', Auth::guard('user')->user());
            $request->session()->put('status_user', 10);
            return $next($request);
        }
        
        return redirect('signout');
    }
}
