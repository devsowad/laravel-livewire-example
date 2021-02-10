<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire;


Route::middleware('auth')->group(function () {
    Route::get('/', Livewire\Home::class)->name('home');
    Route::get('/image', Livewire\FileUpload::class)->name('image');
    Route::get('/logout', [Livewire\Logout::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', Livewire\Login::class)->name('login');
    Route::get('/register', Livewire\Register::class)->name('register');
});
