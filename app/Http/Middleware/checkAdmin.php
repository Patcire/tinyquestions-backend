<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkAdmin
{
    public function handleAdmin(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->is_admin) {
            return $next($request);
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }
}
