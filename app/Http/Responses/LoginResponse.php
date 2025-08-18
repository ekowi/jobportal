<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        // Dapatkan pengguna yang baru saja login
        $user = Auth::user();

        // Cek jika pengguna memiliki peran 'officer'
        if ($user->hasSystemRole('officer')) {
            return redirect()->route('officers.index');
        }

        // Jika tidak, arahkan ke route default untuk kandidat
        return redirect()->intended(config('fortify.home'));
    }
}