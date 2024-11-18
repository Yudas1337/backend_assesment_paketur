<?php

namespace App\Services;

use JWTAuth;
use Tymon\JWTAuth\JWTAuth as JwtReturn;

class LogoutService
{

    /**
     * Handle Logout user.
     * @return JWTAuth
     */
    public function handleLogout(): JwtReturn
    {
        return JWTAuth::invalidate(JWTAuth::getToken());
    }
}
