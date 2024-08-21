<div>
    @foreach($users as $user)
        @livewire('say-hi', ['user' => $user], key($user->name))
    @endforeach

    <hr>
    {{now()}}
    <button wire:click="refreshChildren">Refresh Children</button>
</div>
