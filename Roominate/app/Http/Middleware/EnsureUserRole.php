<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserRole
{
    public function handle($request, Closure $next, $roles)
    {
        if (! $request->user()-> hasRole($roles)) {
            return response()->json(['message' => 'This action is unauthorized'], 403);
        }

        return $next($request);
    }
}
