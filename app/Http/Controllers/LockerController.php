<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Locker;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class LockerController extends Controller
{
    public function index(Request $request): Response
    {
        $activeUsage = $request->user()->history()->whereNull('end_time')->with('locker.location')->first();
        $pastUsage = $request->user()->history()->whereNotNull('end_time')->with('locker.location')->latest('start_time')->paginate(10);

        return response()->view('user.lockers.index', compact('activeUsage', 'pastUsage'))
            ->header('Cache-Control', 'no-store, private');
    }

    public function show(Request $request, Locker $locker): Response
    {
        $locker->load('location');
        $activeUsage = $request->user()->history()->whereNull('end_time')->first();
        $occupied = $locker->history()->whereNull('end_time')->exists();

        return response()->view('user.lockers.show', compact('locker', 'activeUsage', 'occupied'))
            ->header('Cache-Control', 'no-store, private');
    }

    public function start(Request $request, Locker $locker): RedirectResponse
    {
        DB::transaction(function () use ($request, $locker): void {
            User::whereKey($request->user()->id)->lockForUpdate()->firstOrFail();
            $lockedLocker = Locker::whereKey($locker->id)->lockForUpdate()->firstOrFail();
            $activeUsage = $request->user()->history()->whereNull('end_time')->first();

            if ($activeUsage) {
                if ($activeUsage->locker_id === $lockedLocker->id) {
                    return;
                }
                throw ValidationException::withMessages(['locker' => 'Finish using your current locker before choosing another.']);
            }

            if ($lockedLocker->status !== 'Available' || $lockedLocker->history()->whereNull('end_time')->exists()) {
                throw ValidationException::withMessages(['locker' => 'This locker is no longer available. Please choose another.']);
            }

            History::create([
                'locker_id' => $lockedLocker->id,
                'user_id' => $request->user()->id,
                'start_time' => now(),
                'end_time' => null,
                'access_code' => str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT),
            ]);
            $lockedLocker->update(['status' => 'In Use']);
        }, 3);

        return redirect()->route('user.lockers.index')->with('success', 'Your locker is ready. Keep your access code private.');
    }

    public function finish(Request $request, History $history): RedirectResponse
    {
        abort_unless($history->user_id === $request->user()->id, 403);

        DB::transaction(function () use ($request, $history): void {
            User::whereKey($request->user()->id)->lockForUpdate()->firstOrFail();
            $locker = Locker::whereKey($history->locker_id)->lockForUpdate()->firstOrFail();
            $usage = History::whereKey($history->id)->lockForUpdate()->firstOrFail();
            if ($usage->end_time !== null) {
                return;
            }
            $usage->update(['end_time' => now(), 'access_code' => null]);
            if ($locker->status === 'In Use') {
                $locker->update(['status' => 'Available']);
            }
        }, 3);

        return redirect()->route('user.lockers.index')->with('success', 'Usage finished. Your access code has been cleared.');
    }
}
