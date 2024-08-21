<?php

use App\Livewire\Group\Create;
use App\Models\User;
use function Pest\Laravel\actingAs;
use Livewire\Livewire;
use Tests\TestCase;
use function Pest\Livewire\livewire;


it('should be able to create a new group', closure: function (){
     $user = User::factory()->create();
     ActingAs($user);

     livewire(Create::class)->set('name', 'Test Group')->call('createGroup')->assertHasNoErrors();

     \Pest\Laravel\assertDatabaseCount('groups', 1);

});
