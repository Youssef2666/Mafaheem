<?php

use App\Http\Controllers\FaceBookController;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('auth/facebook/redirect', function () {
    return Socialite::driver('facebook')->redirect();
});
 
Route::get('auth/facebook/callback', function () {
    Log::info('reached here');
    $user = Socialite::driver('facebook')->user();
    User::create([
        'name' => $user->name,
        'email' => $user->email,
        'password' => $user->id

    ]);
    return $user;
});

Route::get('users',[FaceBookController::class,'users']);

Route::get('dodo', function(){
    return view('email');
});