<?php

namespace App\Http\Middleware;

use Closure;

class Role
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
        $role = auth()->user()->role;
        if ($role != 'admin') {
            return response()->json([
            'status' => 'error',
            'data' => 'forbidden access',
            ], 403);
        }
        return $next($request);
    }
}
