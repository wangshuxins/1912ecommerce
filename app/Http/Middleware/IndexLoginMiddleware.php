<?php

namespace App\Http\Middleware;

use Closure;

class IndexLoginMiddleware
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
        $login = session('users');
        if(!$login){
            $cookie_login = Request()->cookie('remember');
            if($cookie_login){
                session(['users'=>unserialize($cookie_login)]);
            }
        }
        return $next($request);
    }
}
