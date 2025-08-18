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
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = $request->user();

        // Jika user tidak memiliki role yang diperlukan
        if (!$user->hasRole($role)) {
            // Redirect berdasarkan role yang dimiliki user
            if ($user->hasRole('officer')) {
                return redirect()->route('officers.index');
            } elseif ($user->hasRole('kandidat')) {
                return redirect()->route('dashboard');
            } else {
                // User terautentikasi tapi tidak memiliki role yang valid
                abort(403, 'Unauthorized action.');
            }
        }

        return $next($request);
    }
}
