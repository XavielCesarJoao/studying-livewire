<?php

use App\Livewire\Task\TaskIndex;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware('auth')->group(function () {
    Route::get('tasks', TaskIndex::class)->name('tasks-index');
});

// GIT GUB AUTH
Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('auth.redirect');

Route::get('/auth/callback', function () {
    $gitHubUser = Socialite::driver('github')->user();

    $user = User::updateOrCreate([
        'email' => $gitHubUser->email,
    ], [
            'name' => $gitHubUser->nickname,
            'email' => $gitHubUser->email,
            'remember_token' => $gitHubUser->token,
            'password' => \Illuminate\Support\Facades\Hash::make('1234567890'),
        ]
    );

    Auth::login($user);
    return redirect('/tasks');
    // $user->token
});


require __DIR__ . '/auth.php';
