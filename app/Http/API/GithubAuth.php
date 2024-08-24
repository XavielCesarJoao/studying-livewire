<?php

namespace App\Http\API;

use App\Http\API\Interface\SocialiteInterface;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GithubAuth implements SocialiteInterface
{

    public function __construct(
        protected $data
    )
    {
    }

    public function auth()
    {

        $user = User::updateOrCreate([
            'email' => $this->data->email,
        ], [
                'name' => $this->data->nickname,
                'email' => $this->data->email,
                'remember_token' => $this->data->token,
                'password' => \Illuminate\Support\Facades\Hash::make('1234567890'),
            ]
        );

       Auth::login($user);
    }
}
