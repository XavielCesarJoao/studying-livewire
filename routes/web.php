<?php

use App\Http\API\AuthWithSocialite;
use App\Http\API\GithubAuth;
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

Route::view('dashboard', 'cona')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware('auth')->group(function () {
    Route::get('tasks', TaskIndex::class)->name('tasks-index');
});


 //GIT GUB AUTH
Route::get('/auth/{provider}/redirect', [AuthWithSocialite::class, 'redirect']);

Route::get('/auth/{provider}/callback', [AuthWithSocialite::class, 'callback']);

require __DIR__ . '/auth.php';
