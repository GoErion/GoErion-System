<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\Register;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function store(RegisterRequest $request,Register $action)
    {
        $validated = $request->validated();

        $user = $action->handle($validated);
    }
}
