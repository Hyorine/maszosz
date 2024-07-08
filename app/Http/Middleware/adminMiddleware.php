<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class adminMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        if ($request->session()->has('roles')) {
            $roles = $request->session()->get('roles');
        
            // Check if the first role value is less than 3
            if (isset($roles[0]) && $roles[0] < 4) {
                return $next($request);
            } else {
                return redirect('/');
            }
        }
        

        return redirect('/'); // You can customize the redirection URL
    }
}
