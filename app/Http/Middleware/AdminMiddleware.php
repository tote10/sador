<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AdminMiddleware
 * 
 * Secures routing prefixes by restricting access to authorized admin personnel.
 * 
 * NOTE: This middleware relies on user session initialization. Therefore,
 * the 'auth' middleware MUST precede the 'admin' middleware in the route definition stack
 * to ensure that the current authenticated user context is populated.
 * 
 * @package App\Http\Middleware
 */
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     * Checks if a user is authenticated and possesses admin status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check authentication state
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Validate administrative role privilege
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
