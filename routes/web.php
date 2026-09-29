<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\HistoryController as AdminHistoryController;
use App\Http\Controllers\Admin\LocationController as AdminLocationController;
use App\Http\Controllers\Admin\LockerController as AdminLockerController;
use App\Http\Controllers\Admin\MaintenanceController as AdminMaintenanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LockerController;
use App\Models\Location;
use App\Models\Locker;
use Illuminate\Support\Facades\Route;

// guest route
Route::get('/', function () {
    $locations = Location::with('lockers')->get();
    $lockers = Locker::all();

    return view('user.home', compact('locations', 'lockers'));
})->name('home');

Route::view('/how-to-use', 'user.how-to-use')->name('how-to-use');
Route::view('/about', 'user.about')->name('about');

// guest only
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'index'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.store');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticate'])->name('login.store');
});

// user route
Route::middleware('auth')->name('user.')->group(function () {
    Route::get('/home', fn () => view('user.home'))->name('home');
    // user locations
    Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');
    Route::get('/locations/{location}', [LocationController::class, 'show'])->name('locations.show');
    // user lockers
    Route::get('/lockers', [LockerController::class, 'index'])->name('lockers.index');
    Route::post('/lockers/{locker}/use', [LockerController::class, 'start'])->middleware('throttle:10,1')->name('lockers.start');
    Route::post('/locker-usage/{history}/finish', [LockerController::class, 'finish'])->middleware('throttle:10,1')->name('lockers.finish');
    Route::get('/lockers/{locker}', [LockerController::class, 'show'])->name('lockers.show');

    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// admin route
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // admin locations
    Route::get('/locations', [AdminLocationController::class, 'index'])->name('locations.index');
    Route::get('/locations/create', [AdminLocationController::class, 'create'])->name('locations.create');
    Route::post('/locations', [AdminLocationController::class, 'store'])->name('locations.store');
    Route::put('/locations/{location}', [AdminLocationController::class, 'update'])->name('locations.update');
    Route::get('/locations/{location}/edit', [AdminLocationController::class, 'edit'])->name('locations.edit');
    Route::delete('/locations/{location}', [AdminLocationController::class, 'destroy'])->name('locations.destroy');

    // admin lockers
    Route::get('/lockers', [AdminLockerController::class, 'index'])->name('lockers.index');
    Route::get('/lockers/create', [AdminLockerController::class, 'create'])->name('lockers.create');
    Route::post('/lockers', [AdminLockerController::class, 'store'])->name('lockers.store');
    Route::put('/lockers/{locker}', [AdminLockerController::class, 'update'])->name('lockers.update');
    Route::get('/lockers/{locker}/edit', [AdminLockerController::class, 'edit'])->name('lockers.edit');
    Route::delete('/lockers/{locker}', [AdminLockerController::class, 'destroy'])->name('lockers.destroy');

    // admin maintenance
    Route::get('/maintenances', [AdminMaintenanceController::class, 'index'])->name('maintenances.index');
    Route::get('/maintenances/create', [AdminMaintenanceController::class, 'create'])->name('maintenances.create');
    Route::post('/maintenances', [AdminMaintenanceController::class, 'store'])->name('maintenances.store');
    Route::get('/maintenances/{maintenance}', [AdminMaintenanceController::class, 'show'])->name('maintenances.show');
    Route::get('/maintenances/{maintenance}/edit', [AdminMaintenanceController::class, 'edit'])->name('maintenances.edit');
    Route::put('/maintenances/{maintenance}', [AdminMaintenanceController::class, 'update'])->name('maintenances.update');
    Route::delete('/maintenances/{maintenance}', [AdminMaintenanceController::class, 'destroy'])->name('maintenances.destroy');

    // usage and history
    Route::get('/usage', [AdminHistoryController::class, 'index'])->name('usage.index');
    Route::get('/usage/{usage}', [AdminHistoryController::class, 'show'])->name('usage.show');
});
