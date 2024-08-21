<?php

namespace App\Livewire\Task;

use App\Livewire\Forms\TaskForm;
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

    #[On('editTask')]
    public function editTask($Tasks)
    {
        $this->form->title = $Tasks['title'];
        $this->form->slug = $Tasks['slug'];

    }
}
