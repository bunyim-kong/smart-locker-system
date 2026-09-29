<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use App\Models\Location;
use Illuminate\Http\Request;

class LockerController extends Controller
{
    // Show all lockers (with search + status filter)
    public function index(Request $request)
    {

        $query = Locker::with('location')->latest();
    

        if ($search = $request->input('search')) {  // Get the value from the search box.
            $query->where(function ($q) use ($search) {  // where() use to add a condition to our database query. ប្រើសម្រាប់ដាក់លក្ខខណ្ឌក្នុងការស្វែងរកទិន្នន័យ។
                $q->where('name', 'like', "%{$search}%") // % means anything before or after the search text.
                                                         // LIKE searches for matching text.
                   ->orWhereHas('location', function ($lq) use ($search) { // orWhereHas() OR search in the related Location.
                   $lq->where('name', 'like', "%{$search}%"); // Search location name.
                  });
            });
        }
        if ($status = $request->input('status')) { // Get the selected status from the status filter.
            $query->where('status', $status); // Only show lockers with the selected status.
        }

        $lockers = $query->get();
        // dd($lockers);

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
            'status' => 'required|string|max:50',
            'location_id' => 'required|exists:locations,id',
        ]);

        Locker::create([
            'name' => $request->name,
            'status' => $request->status,
            'location_id' => $request->location_id,
        ]);

        return redirect()->route('lockers.index')->with('success', 'Locker created successfully.');
    }

    // Show single locker
    public function show(Locker $locker)
    {
        $locker->load('location');
        return view('admin.lockers.show', compact('locker'));
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

        return redirect()->route('lockers.index')->with('success', 'Locker updated successfully.');
    }

    // Delete locker
    public function destroy(Locker $locker)
    {
        $locker->delete();
        return redirect()->route('lockers.index')->with('success', 'Locker deleted successfully.');
    }
}