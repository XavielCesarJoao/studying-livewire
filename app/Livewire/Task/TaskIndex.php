<?php

namespace App\Livewire\Task;

use App\Enums\PriorityType;
use App\Enums\StatusType;
use App\Livewire\Forms\TaskForm;
use Illuminate\Support\Facades\Date;
use Livewire\Attributes\Rule;
use Livewire\Component;

class TaskIndex extends Component
{


    public function render()
    {
        return view('livewire.task.task-index')->layout('layouts.app');
    }

}
