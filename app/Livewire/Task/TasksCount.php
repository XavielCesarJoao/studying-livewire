<?php

namespace App\Livewire\Task;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class TasksCount extends Component
{
    #[Reactive]
    public $tasksByStatus;

    public function render()
    {
        return view('livewire.task.tasks-count');
    }
}
