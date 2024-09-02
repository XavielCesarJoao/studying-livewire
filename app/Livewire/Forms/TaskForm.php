<?php

namespace App\Livewire\Forms;

use App\Models\Task;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TaskForm extends Form
{
    //
    public $editMode = false;
    public ?Task $task;
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

    public function createTask()
    {
        if ($this->editMode) {
            $this->task->update($this->all());
            request()->session()->flash('success', __('Task Updated Successfully'));
            $this->reset();
        } else {
            $task = auth()->user()->tasks()->create($this->all());
            request()->session()->flash('success', __('Task Created Successfully'));
            $this->reset();
            return $task;
        }
    }

    public function destro()
    {

    }

    public function edit()
    {
        $this->title = 'ABCD';
    }

    public function setTask(Task $task)
    {
        $this->task = $task;
        $this->editMode = true;
        $this->title = $this->task->title;
        $this->description = $this->task->description;
        $this->slug = $this->task->slug;
        $this->deadline = $this->task->deadline->format('Y-m-d');
        $this->priority = $this->task->priority;
        $this->status = $this->task->status;
    }
}
