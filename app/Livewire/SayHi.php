<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Monolog\Handler\IFTTTHandler;
use Livewire\Attributes\On;

class SayHi extends Component
{

    public $user;
   // protected $listeners = ['refreshChildren' => 'refreshMe'];

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.say-hi');
    }


    #[on('refreshChildren')]
    public function refreshMe()
    {

    }

}
