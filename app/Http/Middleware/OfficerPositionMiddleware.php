<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OfficerPositionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$positions
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$positions): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = $request->user();

        // Ensure user is an officer and has one of the required positions
        $userPosition = optional($user->officer)->jabatan;

        if (!$user->hasRole('officer') || !$userPosition || !in_array($userPosition, $positions, true)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}

