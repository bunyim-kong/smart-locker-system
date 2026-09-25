<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Admin\LocationController as AdminLocationController;
use App\Http\Controllers\Admin\LockerController as AdminLockerController;
use App\Models\Location;
use App\Models\Locker;

// guest route
Route::get('/', function () {
    $locations = Location::with('lockers')->get();
    $lockers = Locker::all();

    return view('user.home', compact('locations', 'lockers'));
})->name('home');

// guest only
Route::middleware('guest')->group( function () {
    Route::get('/register', [AuthController::class, 'index'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.store');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticate'])->name('login.store');
});

// user route 
Route::middleware('auth')->name('user.')->group(function () {
    // user locations
    Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');
    Route::get('/locations/{location}', [LocationController::class, 'show'])->name('locations.show');
    // user lockers
    Route::get('/lockers', [LockerController::class, 'index'])->name('lockers.index');
    Route::get('/lockers/{locker}', [LockerController::class, 'show'])->name('lockers.show');
    
    Route::get('/profile', fn () => view('user.profile'))->name('profile');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// admin route
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function() {
    Route::get('/dashboard', fn () => view('admin.dashboard'))->name('dashboard');

    // admin locations
    Route::get('/locations', [AdminLocationController::class, 'index'])->name('locations');
    Route::get('/locations/create', [AdminLocationController::class, 'create'])->name('locations.create');
    Route::post('/locations', [AdminLocationController::class, 'store'])->name('locations.store');
    Route::put('/locations/{location}', [AdminLocationController::class, 'update'])->name('locations.update');
    Route::get('/locations/{location}/edit', [AdminLocationController::class, 'edit'])->name('locations.edit');
    Route::delete('/locations/{location}', [AdminLocationController::class, 'destroy'])->name('locations.destroy');

    // admin lockers
    Route::get('/lockers', [AdminLockerController::class, 'index'])->name('locations');
    Route::get('/lockers/create', [AdminLockerController::class, 'create'])->name('lockers.create');
    Route::post('/lockers', [AdminLockerController::class, 'store'])->name('lockers.store');
    Route::put('/lockers/{locker}', [AdminLockerController::class, 'update'])->name('lockers.update');
    Route::get('/lockers/{locker}/edit', [AdminLockerController::class, 'edit'])->name('lockers.edit');
    Route::delete('/lockers/{locker}', [AdminLockerController::class, 'destroy'])->name('lockers.destroy');
});












