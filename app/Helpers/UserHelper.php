<?php

namespace App\Helpers;

class UserHelper
{
    /**
     * Handle get user role by Auth
     *
     * @return string
     */
    public static function getUserRole(): string
    {
        return auth()->guard('api')->user()->roles->pluck('name')[0];
    }
}
