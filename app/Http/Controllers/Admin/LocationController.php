<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    //
    public function create()
    {
        return view('admin.locations.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255', 'unique:locations,address'],
            'map_link' => 'required',
        ]);

        Location::create($request->all());
        return redirect()->route('admin.locations.index')->with('success', 'Location created successfully.');
    }

    public function edit(Location $location)
    {
        return view('admin.locations.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'map_link' => 'required',
        ]);

        $location->update($request->all());
        return redirect()->route('admin.locations.index')->with('success', 'Location updated successfully.');
    }
    
    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('admin.locations.index')->with('success', 'Location deleted successfully.'); 
    }
}
