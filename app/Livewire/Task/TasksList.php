<?php

namespace App\Livewire\Task;

use App\Livewire\Forms\TaskForm;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class TasksList extends Component
{
    use WithPagination;

    public TaskForm $form;

    public function render()
    {
        return view('livewire.task.tasks-list');
    }

    public function placeholder()
    {
        return view('skeleton');
    }

    public function changeStatus($id, $value)
    {
        try {
            $task = Task::updateAttribute($id, 'status', $value);
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar status', $e);
        }

        unset($this->tasks);
        unset($this->tasksByStatus);
    }

    #[Computed()]
    public function tasks()
    {
        return auth()->user()->tasks()->orderBy('id', 'desc')->paginate(2);
    }


    #[Computed(cache: true)]
    public function tasksByStatus()
    {
        return auth()->user()->tasks()->select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->orderBy('status', 'desc')
            ->get();
    }

    #[On('task-created')]
    public function taskCreated()
    {
        unset($this->tasksByStatus);
        unset($this->tasks);
    }

}
