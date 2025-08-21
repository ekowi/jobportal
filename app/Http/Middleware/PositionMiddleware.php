<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PositionMiddleware
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
        $user = $request->user();

        if (!$user) {
            return redirect('login');
        }

        foreach ($positions as $position) {
            if ($user->hasPosition($position)) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized action.');
    }
}
