<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Locker;
use App\Models\Location;

class LockerController extends Controller
{
    //
    public function create()
    {
        $locations = Location::all();

        return view('admin.lockers.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:50',
            'location_id' => 'required|exists:locations,id',
        ]);

        Locker::create([
            'name' => $request->name,
            'status' => $request->status,
            'location_id' => $request->location_id,
        ]);

        return redirect()
            ->route('admin.lockers.index')->with('success', 'Locker created successfully.');
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
            'status' => 'required|string|max:50',
            'location_id' => 'required|exists:locations,id',
        ]);

        $locker->update([
            'name' => $request->name,
            'status' => $request->status,
            'location_id' => $request->location_id,
        ]);

        return redirect()
            ->route('admin.lockers.index')->with('success', 'Locker updated successfully.');
    }

    // Delete locker
    public function destroy(Locker $locker)
    {
        $locker->delete();

        return redirect()->route('admin.lockers.index')->with('success', 'Locker deleted successfully.');
    }
}
