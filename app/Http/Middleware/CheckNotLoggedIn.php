<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckNotLoggedIn
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is not authenticated
        if (Auth::check()) {
            // Redirect to the home page or another route
            return redirect()->route('/');
        }

        // Continue with the request
        return $next($request);
    }
}
