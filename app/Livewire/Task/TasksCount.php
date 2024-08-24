<?php

namespace App\Livewire\Task;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class TasksCount extends Component
{


    public string $color = 'border-blue-500';
    #[Reactive]
    public $tasksByStatus;

    public function render()
    {
        return view('livewire.task.tasks-count');
    }
}
