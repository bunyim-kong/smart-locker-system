<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Location;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    //
    public function index(Request $request)
    {
        $activeUsage = History::whereNull('end_time')->with(['user', 'locker.location'])->get();

        $pastUsage = History::whereNotNull('end_time')
            ->with(['user', 'locker.location'])
            ->latest('start_time')
            ->paginate(10);

        return view('admin.usage.index', [
            'activeUsage' => $activeUsage,
            'pastUsage' => $pastUsage,
            'locations' => Location::orderBy('name')->get(),
        ]);
    }

    public function show(History $history)
    {
        $history->load(['user', 'locker.location']);

        return view('admin.usage.show', compact('history'));
    }
}
