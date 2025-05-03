<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class,'registrationPage'])->name('register');
Route::post('/register', [AuthController::class,'register'])->name('register.post');

Route::get('/login', [AuthController::class,'loginPage'])->name('login');
Route::post('/login', [AuthController::class,'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('auth');

Route::resource('categories', CategoryController::class)->middleware('auth');
Route::resource('posts', PostController::class)->middleware('auth');