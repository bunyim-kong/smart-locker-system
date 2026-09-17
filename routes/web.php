<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [AuthController::class, 'index'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'authenticate'])->name('login.store');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function() {
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function() {
    Route::get('/admin/dashboard', function () { 
        return view('admin.dashboard'); })->name('admin.dashboard');
});



