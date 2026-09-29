<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LocationController extends Controller
{
    public function index(Request $request): View
    {
        $query = Location::with('lockers');

        if ($search = $request->string('search')->trim()->toString()) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")->orWhere('address', 'like', "%{$search}%");
            });
        }

        if ($request->boolean('free')) {
            $query->whereHas('lockers', fn ($query) => $query->where('status', 'Available'));
        }

        $locations = $query->get();

        return view('admin.locations.index', compact('locations'));
    }

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
        if ($location->lockers()->exists()) {
            return redirect()->route('admin.locations.index')->with('Error', 'Location cannot be delete');
        }

        $location->delete();

        return redirect()->route('admin.locations.index')->with('success', 'Location deleted successfully.');
    }
}
