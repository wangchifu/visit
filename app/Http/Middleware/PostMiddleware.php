<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PostMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && (Auth::user()->group_id == 1 or Auth::user()->group_id == 4)) {
        //若users資料表內的group_id欄為1，則下一個request，否則返回 /
            return $next($request);
        }

        abort('403','請以管理員身份或職探中心帳號登入');
    }
}
