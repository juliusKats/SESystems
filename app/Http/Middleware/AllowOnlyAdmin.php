<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AllowOnlyAdmin
{
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role=="superadmin" && Auth::user()->status== true) {
            return $next($request);
        }
        Abort(403);
    }
}
