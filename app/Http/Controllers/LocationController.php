<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('locations.index', compact('locations'));
    }
    public function create()
    {
        return view('locations.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'map_link' => 'required',
        ]);

        Location::create($request->all());
        return redirect()->route('locations.index')->with('success', 'Location created successfully.');
    }
    public function show(Location $location)
    {
        return view('locations.show', compact('location'));
    }
    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'map_link' => 'required',
        ]);

        $location->update($request->all());
        return redirect()->route('locations.index')->with('success', 'Location updated successfully.');
    }
    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('locations.index')->with('success', 'Location deleted successfully.'); 
    }
}
