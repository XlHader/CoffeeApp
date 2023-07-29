<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return response()->json([
                    'message' => 'Token is invalid',
                    'error' => true
                ], 400);
            } else if ($e instanceof TokenExpiredException) {
                return response()->json([
                    'message' => 'Token is expired',
                    'error' => true
                ], 400);
            } else {
                return response()->json([
                    'message' => 'Token is not found',
                    'error' => true
                ], 400);
            }
        }

        return $next($request);
    }
}
