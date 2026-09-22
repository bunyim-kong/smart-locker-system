<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\LocationController;

Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');
Route::get('/locations/create', [LocationController::class, 'create'])->name('locations.create');
Route::post('/locations', [LocationController::class, 'store'])->name('locations.store');
Route::get('/locations/{location}', [LocationController::class, 'show'])->name('locations.show');
Route::get('/locations/{location}/edit', [LocationController::class, 'edit'])->name('locations.edit');
Route::put('/locations/{location}', [LocationController::class, 'update'])->name('locations.update');
Route::delete('/locations/{location}', [LocationController::class, 'destroy'])->name('locations.destroy');


Route::get('/', function () {
    return view('welcome');
});

// Show all lockers
// Route::get('/lockers', [LockerController::class, 'index'])->name('lockers.index');
// Route::get('/lockers/create', [LockerController::class, 'create'])->name('lockers.create');
// Route::post('/lockers', [LockerController::class, 'store'])->name('lockers.store');
// Route::get('/lockers/{locker}', [LockerController::class, 'show'])->name('lockers.show');
// Route::get('/lockers/{locker}/edit', [LockerController::class, 'edit'])->name('lockers.edit');
// Route::put('/lockers/{locker}', [LockerController::class, 'update'])->name('lockers.update');
// Route::delete('/lockers/{locker}', [LockerController::class, 'destroy'])->name('lockers.destroy');

// Route::name('admin.')->group(function () {
//     Route::resource('lockers', LockerController::class);
// });

Route::get('/lockers', [LockerController::class, 'index'])->name('lockers.index');
Route::get('/lockers/create', [LockerController::class, 'create'])->name('lockers.create');
Route::post('/lockers', [LockerController::class, 'store'])->name('lockers.store');
Route::get('/lockers/{locker}', [LockerController::class, 'show'])->name('lockers.show');
Route::get('/lockers/{locker}/edit', [LockerController::class, 'edit'])->name('lockers.edit');
Route::put('/lockers/{locker}', [LockerController::class, 'update'])->name('lockers.update');
Route::delete('/lockers/{locker}', [LockerController::class, 'destroy'])->name('lockers.destroy');