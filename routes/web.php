<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LockerController;

Route::get('/', function () {
    return view('welcome');
});

// Show all lockers
Route::get('/lockers', [LockerController::class, 'index'])->name('lockers.index');
Route::get('/lockers/create', [LockerController::class, 'create'])->name('lockers.create');
Route::post('/lockers', [LockerController::class, 'store'])->name('lockers.store');
Route::get('/lockers/{locker}', [LockerController::class, 'show'])->name('lockers.show');
Route::get('/lockers/{locker}/edit', [LockerController::class, 'edit'])->name('lockers.edit');
Route::put('/lockers/{locker}', [LockerController::class, 'update'])->name('lockers.update');
Route::delete('/lockers/{locker}', [LockerController::class, 'destroy'])->name('lockers.destroy');