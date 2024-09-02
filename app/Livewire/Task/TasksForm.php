<?php

namespace App\Livewire\Task;

use App\Livewire\Forms\TaskForm;
use App\Models\Task;
use Livewire\Attributes\On;
use Livewire\Component;

class TasksForm extends Component
{

    public TaskForm $form;

    public function save()
    {
        $this->form->validate();
        $task = $this->form->createTask();
        $this->dispatch('task-created');
        $this->form->reset();
    }


    public function render()
    {
        return view('livewire.task.tasks-form');
    }

    #[On('edit-task')]
    public function editTask($id)
    {
        $task = Task::findOrFail($id);
        $this->form->setTask($task);
    }

    public function cancel()
    {
        $this->form->reset();
    }
}
