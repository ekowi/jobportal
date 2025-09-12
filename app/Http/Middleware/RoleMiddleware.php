<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role, ...$positions)
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
                abort(403, 'Unauthorized action.');
            }
        }

        // Validasi jabatan officer jika posisi ditentukan
        if ($role === 'officer' && !empty($positions)) {
            $allowed = array_map('strtolower', $positions);
            $jabatan = optional($user->officer)->jabatan;

            if (!$jabatan || !in_array(strtolower($jabatan), $allowed, true)) {
                // Jika jabatan tidak diizinkan, arahkan kembali ke dashboard officer
                return redirect()->route('officers.index');
            }
        }

        return $next($request);
    }
}
