<div>


    <input type="text" wire:model="task" wire:keydown.shift.enter="add">
    <button class="bg-indigo-500 p-2" wire:click="add">ADD</button>
    <ul>
        @foreach($tasks as $task)
          <li>{{$task}}</li>
        @endforeach
    </ul>

</div>
