<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class HelloWorld extends Component
{

    public $users;
    private $matricula = '009TF555';

    public function mount()
    {
        $this->users = User::all();
    }
    public function render()
    {
        return view('livewire.hello-world');
    }

    public function refreshChildren()
    {
        $this->dispatch('refreshChildren', matricula: $this->matricula);
    }
}
