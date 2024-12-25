<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class MultiAuthUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next,$userType): Response
    {
        $user = Auth::user();
        if ($user && $user->type == $userType) {
            return $next($request);
        }
         return response()->json('You are not Authorized To Access This Page', 403); // Include p
    }
}
