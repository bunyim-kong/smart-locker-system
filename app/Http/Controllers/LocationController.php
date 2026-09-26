<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Locker;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        $lockers = Locker::all();

        return view('user.locations.index', compact('locations', 'lockers'));
    }

    public function show(Location $location)
    {
        return Auth::user()->isAdmin() 
            ? view('admin.locations.show', compact('location'))
            : view('user.locations.show', compact('location'));
    }
}
