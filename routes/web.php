<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;


Route::get('/', [HomeController::class, 'showHomePage'])->name('home');

Route::middleware('guest')->group(function(){
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('login.post');
});

Route::middleware(RedirectIfAuthenticated)->group(function(){
    Route::view('/dashboard', 'dashboard.index')->name('dashboard.index');
});

Route::view('/test', 'test');
