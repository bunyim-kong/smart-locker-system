<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use App\Models\Location;
use Illuminate\Http\Request;

class LockerController extends Controller
{
    // Show all lockers
    public function index()
    {
        $lockers = Locker::with('location')->latest()->get();
        return view('admin.lockers.index', compact('lockers'));
    }

    // Show create locker form
    public function create()
    {
        $locations = Location::all();
        return view('admin.lockers.create', compact('locations'));
    }

    // Save new locker to database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'size' => 'required|in:Small,Medium,Large',
            'status' => 'required|string|max:50',
            'location_id' => 'required|exists:locations,id',
        ]);

        Locker::create([
            'name' => $request->name,
            'size' => $request->size,
            'status' => $request->status,
            'location_id' => $request->location_id,
        ]);

        return redirect()->route('lockers.index')->with('success', 'Locker created successfully.');
    }

    // Show edit locker form
    public function edit(Locker $locker)
    {
        $locations = Location::all();
        return view('admin.lockers.edit', compact('locker', 'locations'));
    }

    // Update locker in database
    public function update(Request $request, Locker $locker)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'size' => 'required|in:Small,Medium,Large',
            'status' => 'required|string|max:50',
            'location_id' => 'required|exists:locations,id',
        ]);

        $locker->update([
            'name' => $request->name,
            'size' => $request->size,
            'status' => $request->status,
            'location_id' => $request->location_id,
        ]);

        return redirect()->route('lockers.index')->with('success', 'Locker updated successfully.');
    }

    // Delete locker
    public function destroy(Locker $locker)
    {
        $locker->delete();
        return redirect()->route('lockers.index')->with('success', 'Locker deleted successfully.');
    }

    public function show(Locker $locker)
    {
        $locker->load('location', 'history');
        return view('admin.lockers.show', compact('locker'));
    }
}