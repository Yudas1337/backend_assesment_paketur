<?php

namespace App\Services;

use App\Helpers\UserHelper;
use App\Http\Requests\LoginRequest;

class LoginService
{
    /**
     * Handle Login user.
     * @param LoginRequest $request
     * @return bool|object
     */
    public function handleLogin(LoginRequest $request): bool|object
    {
        $guard = auth()->guard('api');
        if (!$token = $guard->attempt($request->validated())) return false;

        return (object)[
            'user' => $guard->user(),
            'token' => $token,
            'role' => UserHelper::getUserRole()
        ];
    }
}
