<?php

namespace App\Actions\Fortify;

use App\Models\Representative;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewRepresentatives;
use Laravel\Fortify\Rules\Password;
use App\Actions\Fortify\Log;

class CreateNewRepresentative implements CreatesNewRepresentatives
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * 
     * @param  array<string, string>  $input
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(Representative::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        return Representative::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
