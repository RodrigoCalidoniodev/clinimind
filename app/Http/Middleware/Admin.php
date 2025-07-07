<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user()->is_admin === 0) {
            // If the user is not an admin, redirect them to the client dashboard
            return redirect()->route('client.index')->with('error', 'You do not have permission to access this area.');
        }
        return $next($request);
    }
}
