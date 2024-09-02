<div class="w-7/12">
    <livewire:task.tasks-count :tasksByStatus="$this->tasksByStatus"/>

    @if(true)
        <div class="px-6">
            @foreach($this->tasks as $task)
                <div
                    class="my-4 px-4 py-6 bg-white rounded-lg shadow hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700"
                >
                    <div class="p-4 leading-normal">
                        <div class="flex justify-between mb-4">
                            <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $task->title }}
                            </h5>
                            <span
                                class="px-2 py-1 border border-slate-200 rounded-md flex justify-end">{{ $task->deadline->diffForHumans() }}</span>
                        </div>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $task->description }}</p>
                    </div>
                    <div class="flex justify-between">
                        <div>
                            @foreach(\App\Enums\StatusType::cases() as $case)
                                <button
                                    wire:click.prevent="changeStatus({{$task->id}},'{{$case->value}}')"
                                    {{$case->value == $task->status->value ? 'disabled' : ''}}
                                    @class(['inline-flex items-center px-4 py-2 bg-white border rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150',
                                    $case->color() => true
                                    ])
                                >
                                    {{\Illuminate\Support\Str::of($case->value)->headline()}}
                                </button>
                            @endforeach
                        </div>
                        <div>
                            <x-primary-button
                                class="bg-green-500 hover:bg-green-700 focus:bg-green-900 active:bg-green-800"
                                wire:click="$dispatch('edit-task', {id: {{ $task->id }}})">Edit
                            </x-primary-button>
                            <x-primary-button
                                class="bg-red-500 hover:bg-red-700 focus:bg-red-500 active:bg-red-800"
                                wire:click="delete( {{ $task->id }} )"
                                wire:confirm="Queres apagar este resgiosto ?"
                            >
                                Delete
                            </x-primary-button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-2 mb-12 p-2">
            {{ $this->tasks->links() }}
        </div>
    @endif
</div>
