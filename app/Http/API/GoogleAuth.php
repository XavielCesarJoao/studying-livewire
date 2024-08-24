<?php

namespace App\Http\API;

use App\Http\API\Interface\SocialiteInterface;

class GoogleAuth implements SocialiteInterface
{

    public function __construct(
        public $data = null
    )
    {
    }

    public function auth()
    {
        dd('Porraz trabalha a parte da autenticação com google');
    }
}
