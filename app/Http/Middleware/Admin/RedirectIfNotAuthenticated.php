<?php

namespace App\Http\Middleware\Admin;

use App\Helper\MyFuncs;
use Auth;
use Closure;
class RedirectIfNotAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'user')
    {  
        if (!Auth::guard($guard)->check()) {
            return redirect()->route('admin.login');
        }
        
        return $next($request);
    }
}
