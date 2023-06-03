<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Exception;
use JWTAuth;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $userArr = JWTAuth::parseToken()->authenticate();
            if (!$userArr) {
                return response()->json(['status' => FALSE, 'error' => 'Token is Invalid'], 401);
            }
            $request->session()->put('user_id', (int)$userArr->id);
        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return response()->json(['status' => FALSE, 'error' => 'Token is Invalid'], 401);
            } else if ($e instanceof TokenExpiredException) {
                return response()->json(['status' => FALSE, 'error' => 'Token is Expired'], 401);
            } else {
                return response()->json(['status' => FALSE, 'error' => 'Authorization Token not found'], 401);
            }
        }
        return $next($request);
    }
}
