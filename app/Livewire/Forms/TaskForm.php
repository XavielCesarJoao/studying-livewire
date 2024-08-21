<?php

namespace App\Livewire\Forms;

use App\Models\Task;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TaskForm extends Form
{
    //
    #[Rule('required|min:5|max:28')]
    public $title;
    #[Rule('required|min:5|max:28')]
    public $slug;
    #[Rule('required|min:20|max:200')]
    public $description;
    #[Rule('required')]
    public $priority = 'low';
    #[Rule('required')]
    public $status = 'started';
    #[Rule('required')]
    public $deadline;
    public $active;

    public function createTask(): Task
    {
        $task = auth()->user()->tasks()->create($this->all());
        request()->session()->flash('success', __('Task Created Successfully'));
        return $task;
    }

    public function edit()
    {
        $this->title = 'ABCD';
    }

}
