<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = $request->user();

        foreach ($roles as $role) {
            // Allow if user has role or matching position
            if ($user->hasRole($role) || $user->hasPosition($role)) {
                return $next($request);
            }

            // Manager has access to all officer features
            if (in_array($role, ['officer', 'recruiter', 'coordinator', 'manager'])
                && $user->hasPosition('manager')) {
                return $next($request);
            }
        }

        // Redirect based on available role
        if ($user->hasRole('officer')) {
            return redirect()->route('officers.index');
        } elseif ($user->hasRole('kandidat')) {
            return redirect()->route('dashboard');
        }

        // User terautentikasi tapi tidak memiliki role yang valid
        abort(403, 'Unauthorized action.');
    }
}
