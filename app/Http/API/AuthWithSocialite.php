<?php

namespace App\Http\API;

use App\Http\API\Interface\SocialiteInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;

class AuthWithSocialite
{
    public function redirect($provider)
    {

        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $dataUser = Socialite::driver($provider)->user();

        if ($provider === 'github'){
            $this->auth(new GithubAuth($dataUser));
            dd(4);
        }

        if ($provider === 'google'){
            $this->auth(new GoogleAuth($dataUser));
        }

        return redirect('/dashboard');
    }

    public function auth(SocialiteInterface $socialite)
    {
        $socialite->auth();
        return redirect('/dashboard');
    }
}
