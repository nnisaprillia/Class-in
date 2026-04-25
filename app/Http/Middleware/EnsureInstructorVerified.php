<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureInstructorVerified
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || $user->role !== 'instructor' || $user->instructor_verified) {
            return $next($request);
        }

        return redirect()->route('instructor.dashboard')
            ->with('instructor_notice', 'Akun instruktur Anda belum tervalidasi admin. Silakan lengkapi form pengajuan.');
    }
}
