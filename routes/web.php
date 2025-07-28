<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register.post');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::get('/category/{slug}', [App\Http\Controllers\CategoryController::class, 'show'])->name('category.show');
Route::get('/audio/{id}', [App\Http\Controllers\AudioController::class, 'show'])->name('audio.show');


Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/categories', App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('/audios', App\Http\Controllers\Admin\AudioController::class);
});