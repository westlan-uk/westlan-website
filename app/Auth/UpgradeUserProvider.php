<?php

namespace App\Auth;

use App\User;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Support\Facades\Hash;

class UpgradeUserProvider extends EloquentUserProvider
{

    public function validateCredentials(UserContract $user, array $credentials)
    {
        $upgraded = $user->site_upgraded;

        if ($upgraded) {
            return parent::validateCredentials($user, $credentials);
        } else {
            $plainPass = $credentials['password'];
            $pass = $plainPass . env('OLD_SALT');
            $hashedPass = hash('sha1', $pass);

            if ($user->getAuthPassword() === $hashedPass) {
                $user->site_upgraded = 1;
                $user->password = Hash::make($plainPass);
                $user->save();
                return true;
            } else {
                return false;
            }
        }
    }
}
