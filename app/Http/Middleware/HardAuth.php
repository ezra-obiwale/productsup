<?php

namespace App\Http\Middleware;

use Closure;

class HardAuth
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
        $token = config('productsup.token');
        if ($request->header('token') !== $token &&
            $request->token !== $token) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized'
                ], 401);
            }
        return $next($request);
    }
}
