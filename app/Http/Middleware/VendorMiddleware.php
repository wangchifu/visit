<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VendorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = null)
    {
        if (Auth::guard($guard)->check() && (Auth::user()->group_id >= 8 )) {
            //若users資料表內的group_id欄為8，則下一個request，否則返回 /
            return $next($request);
        }

        return redirect()->route('index');
    }
}
