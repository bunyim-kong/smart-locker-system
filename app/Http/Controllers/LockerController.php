<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LockerController extends Controller

{
    public function index()
    {
        $lockers = Locker::with('location')->get();

        return Auth::user()->isAdmin()
            ? view('admin.lockers.index', compact('lockers'))
            : view('user.lockers.index', compact('lockers'));
    }

    public function show(Locker $locker) {
        $locker -> load('location');

        return Auth::user()->isAdmin()
            ? view('admin.lockers.index', compact('locker'))
            : view('user.lockers.index', compact('locker'));
    }
}