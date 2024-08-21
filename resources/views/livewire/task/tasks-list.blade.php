<div class="w-7/12">
    <livewire:task.tasks-count :$tasksByStatus />
    <div class="px-6">
        @foreach($tasks as $task)
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
                <button wire:click="editTask({{$task}})" class="flex mt-2 py-2 px-4 bg-green-500 hover:bg-green-300 text-white rounded-md">EDIT</button>
            </div>
        @endforeach
    </div>
    <div class="mt-2 mb-12 p-2">
        {{ $tasks->links() }}
    </div>
</div>
