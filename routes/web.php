<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Login routes harus di luar closure
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');