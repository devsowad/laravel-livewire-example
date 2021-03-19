<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire;


Route::get('/image', Livewire\FileUpload::class)->name('image');
Route::middleware('auth')->group(function () {
    Route::get('/', Livewire\Home::class)->name('home');
    Route::get('/logout', [Livewire\Logout::class, 'logout'])->name('logout');
    Route::get('/things', Livewire\Things::class)->name('things');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', Livewire\Login::class)->name('login');
    Route::get('/register', Livewire\Register::class)->name('register');
});
