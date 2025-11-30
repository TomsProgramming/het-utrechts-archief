<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


Route::get('/', [HomeController::class, 'showHomePage']);
Route::view('/login', 'auth.login');

Route::view('/test', 'test');
