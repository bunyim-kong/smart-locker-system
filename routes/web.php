<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('/register', [AuthController::class, 'index'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authentication'])->name('login.authentication');

Route::middleware('auth')->post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return view('front.home');
});

Route::get('/location', function () {
    return view('front.locations.index');
});

Route::get('/location-detail', function () {
    return view('front.locations.show');
});

Route::get('/lockers', fn() => view('front.lockers.index'))->name('lockers.index');
Route::get('/locker', fn() => view('front.lockers.show'))->name('lockers.show');