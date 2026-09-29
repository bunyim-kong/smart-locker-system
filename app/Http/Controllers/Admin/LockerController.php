<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Locker;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LockerController extends Controller
{
    public function index(Request $request): View
    {
        $query = Locker::with('location');

        if ($search = $request->string('search')->trim()->toString()) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")->orWhereHas('location', fn ($query) => $query->where('name', 'like', "%{$search}%"));
            });
        }

        if (in_array($request->input('status'), ['Available', 'In Use', 'Maintenance'], true)) {
            $query->where('status', $request->input('status'));
        }

        $lockers = $query->get();

        return view('admin.lockers.index', compact('lockers'));
    }

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

        DB::transaction(function () use ($request, $locker): void {
            $lockedLocker = Locker::whereKey($locker->id)->lockForUpdate()->firstOrFail();
            if ($lockedLocker->history()->whereNull('end_time')->exists()
                && ($request->status !== 'In Use' || (int) $request->location_id !== $lockedLocker->location_id)) {
                throw ValidationException::withMessages(['status' => 'This locker has an active user. Its status and location cannot change until usage ends.']);
            }
            $lockedLocker->update([
                'name' => $request->name,
                'status' => $request->status,
                'location_id' => $request->location_id,
            ]);
        });

        return redirect()
            ->route('admin.lockers.index')->with('success', 'Locker updated successfully.');
    }

    // Delete locker
    public function destroy(Locker $locker): RedirectResponse
    {
        DB::transaction(function () use ($locker): void {
            $lockedLocker = Locker::whereKey($locker->getKey())->lockForUpdate()->firstOrFail();

            if ($lockedLocker->history()->whereNull('end_time')->exists()) {
                throw ValidationException::withMessages(['locker' => 'Finish the active locker session before deleting this locker.']);
            }

            $lockedLocker->delete();
        });

        return redirect()->route('admin.lockers.index')->with('success', 'Locker deleted successfully.');
    }
}
