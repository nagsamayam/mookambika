<?php

namespace App\Http\Middleware;

use App\User;
use Auth;
use Closure;

class VerifyAdmins
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->user()->can('admin', User::class)) {
            return $next($request);
        }

        return redirect('/');
    }
}
