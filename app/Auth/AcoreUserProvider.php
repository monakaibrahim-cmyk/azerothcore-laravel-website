<?php

namespace App\Auth;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Services\AzerothCoreAuth;

class AcoreUserProvider extends EloquentUserProvider
{
    public function validateCredentials(Authenticatable $user, array $credentials): bool
    {
        if (empty($credentials['password']))
        {
            return false;
        }

        return AzerothCoreAuth::verifySrp6(
            $user->username, 
            $credentials['password'], 
            $user->salt, 
            $user->verifier
        );
    }
}
