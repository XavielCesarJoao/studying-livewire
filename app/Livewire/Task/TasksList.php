<?php

namespace App\Livewire\Task;

use App\Livewire\Forms\TaskForm;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class TasksList extends Component
{
    use WithPagination;
    public TaskForm $form;

    #[On('task-created')]
    public function render()
    {
        return view('livewire.task.tasks-list', [
            'tasks' => auth()->user()->tasks()->paginate(3),
            'tasksByStatus' => auth()->user()->tasks()
                ->select('status', DB::raw('COUNT(*) as count'))
                ->groupBy('status')
                ->orderBy('status', 'desc')
                ->get(),]);
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

    }

}
