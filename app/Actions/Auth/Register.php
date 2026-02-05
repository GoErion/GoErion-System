<?php

namespace App\Actions\Auth;

use App\Models\User;

class Register
{
    public function handle(array $input)
    {
        return User::create([
            //
        ]);
    }
}
