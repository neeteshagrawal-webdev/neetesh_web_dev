<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {


         // Routes that should be accessible to guests
        $allowedRoutes = [
            'password.request', // Forgot password page
            'password.email',   // Forgot password form submission
            'password.reset',   // Reset password page
            'password.update'   // Reset password form submission
        ];

       /* if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }*/
         if (!Auth::check() && !in_array($request->route()->getName(), $allowedRoutes)) {
            return redirect()->route('login'); // Redirect unauthenticated users
        }
        return $next($request);
    }
}