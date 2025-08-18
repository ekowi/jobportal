<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PositionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$positions
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$positions)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = $request->user();

        if (!$user->hasSystemRole('officer') || !$user->officer) {
            return redirect()->route('dashboard');
        }

        $userPosition = strtolower($user->officer->jabatan);
        $positions = array_map(fn($p) => strtolower(trim($p)), $positions);

        if (!in_array($userPosition, $positions)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
