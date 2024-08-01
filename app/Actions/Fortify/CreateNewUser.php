<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Orchid\Platform\Models\Role;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input)
    {
        Validator::make($input, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();

        $roles = Role::where('name','client')->get()->first();
        $user = User::create([
            'name' => strstr($input['email'],'@',true),
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        $user->addRole($roles);

        return $user;
    }
}
