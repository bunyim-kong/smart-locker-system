<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();

        return Auth::user()->isAdmin() 
            ? view('admin.locations.index', compact('locations'))
            : view('user.locations.index', compact('locations'));
    }

    public function show(Location $location)
    {
        return Auth::user()->isAdmin() 
            ? view('admin.locations.show', compact('location'))
            : view('user.locations.show', compact('location'));
    }
}
