<?php

namespace App\Livewire\Group;

use App\Models\Group;
use Livewire\Component;

class Create extends Component
{
    public ?string $name = null;

    public function render()
    {
        return view('livewire.group.create');
    }

    public function createGroup()
    {
        Group::query()->create(['name' => $this->name, 'user_id' => auth()->id()]);
    }
}
