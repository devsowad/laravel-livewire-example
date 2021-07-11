<?php

use App\Http\Livewire\FileUpload;
use App\Http\Livewire\Home;
use App\Http\Livewire\Login;
use App\Http\Livewire\Logout;
use App\Http\Livewire\Register;
use App\Http\Livewire\Things;
use Illuminate\Support\Facades\Route;

Route::get('/image', FileUpload::class)->name('image');
Route::get('/things', Things::class)->name('things');

Route::middleware('auth')->group(function () {
    Route::get('/', Home::class)->name('home');
    Route::get('/logout', [Logout::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});
