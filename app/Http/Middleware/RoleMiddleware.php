<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->user()) {
            return redirect('/login');
        }

        if ($request->user()->role !== $role) {
            // Redirect to appropriate dashboard based on user role
            return match ($request->user()->role) {
                'admin' => redirect('/admin/dashboard'),
                'instructor' => redirect('/instructor/dashboard'),
                'student' => redirect('/student/dashboard'),
                default => redirect('/login'),
            };
        }

        return $next($request);
    }
}