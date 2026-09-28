<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Location;
use App\Models\Locker;

class DashboardController extends Controller
{
    public function index()
    {
        $counts = Locker::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $total = $counts->sum();
        $inUse = $counts['In Use'] ?? 0;

        $stats = [
            'total' => $total,
            'available' => $counts['Available'] ?? 0,
            'in_use' => $inUse,
            'maintenance' => $counts['Maintenance'] ?? 0,
            'occupancy' => $total > 0 ? round($inUse / $total * 100) : 0,
            'today' => History::whereDate('start_time', today())->count(),
        ];

        // Sessions per day, last 7 days
        $perDay = History::where('start_time', '>=', now()->subDays(6)->startOfDay())
            ->selectRaw('DATE(start_time) as day, COUNT(*) as total')
            ->groupBy('day')
            ->pluck('total', 'day');

        $week = collect(range(6, 0))->map(function ($i) use ($perDay) {
            $date = now()->subDays($i);

            return [
                'label' => $date->format('D'),
                'count' => $perDay[$date->toDateString()] ?? 0,
            ];
        });

        $activeUsage = History::whereNull('end_time')
            ->with(['user', 'locker.location'])
            ->latest('start_time')
            ->take(6)
            ->get();

        $locations = Location::withCount([
            'lockers',
            'lockers as in_use_count' => fn ($q) => $q->where('status', 'In Use'),
            'lockers as available_count' => fn ($q) => $q->where('status', 'Available'),
        ])
            ->orderBy('name')
            ->get();

        return view('admin.dashboard', compact('stats', 'week', 'activeUsage', 'locations'));
    }
}
