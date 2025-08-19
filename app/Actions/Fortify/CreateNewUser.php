<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Kandidat;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        $testData = Session::get('guest_test_data');
        if (!$testData || !isset($testData['bmi'], $testData['blind'])) {
            throw ValidationException::withMessages([
                'email' => 'Silakan lakukan tes BMI dan tes buta warna terlebih dahulu.',
            ]);
        }

        if (($testData['bmi']['kategori'] ?? '') !== 'Normal' || ($testData['blind']['score'] ?? 0) < 60) {
            throw ValidationException::withMessages([
                'email' => 'Hasil tes BMI atau tes buta warna tidak memenuhi syarat.',
            ]);
        }

        Validator::make($input, [
            'nama_depan' => ['required', 'string', 'max:255'],
            'nama_belakang' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user = User::create([
            'name' => trim($input['nama_depan'].' '.($input['nama_belakang'] ?? '')),
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        Kandidat::create([
            'user_id' => $user->id,
            'nama_depan' => $input['nama_depan'],
            'nama_belakang' => $input['nama_belakang'] ?? null,
            'bmi_score' => $testData['bmi']['score'],
            'blind_score' => $testData['blind']['score'],
            'user_create' => $user->id,
        ]);

        return $user;
    }
}
