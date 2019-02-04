<?php

namespace FacebookBot\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIsAdmin
{

    public function handle($request, Closure $next)
    {
        if (Auth::user()->role === 'admin') {
            return $next($request);
        } else {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

}
