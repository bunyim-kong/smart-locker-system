@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<section class="mx-auto flex flex-col gap-6 lg:gap-8">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div class="space-y-1.5">
            <p class="text-xs font-semibold uppercase tracking-widest text-blue-600">Workspace overview</p>
            <span class="text-sm text-slate-500">{{ now()->format('d M Y') }}</span>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            
            <a href="{{ route('admin.lockers.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition-colors hover:bg-blue-700 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-blue-600">
                <span aria-hidden="true" class="text-lg leading-none">+</span> Add locker
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 min-[380px]:grid-cols-2 xl:grid-cols-4">
        <div class="relative overflow-hidden rounded-2xl bg-slate-900 p-5 text-white shadow-sm sm:p-6">
            <svg aria-hidden="true" class="absolute -right-4 -bottom-6 size-32 text-white/5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><rect x="3" y="2" width="18" height="20" rx="3"/><path d="M12 2v20M8 10v4m8-4v4"/></svg>
            <p class="text-sm font-medium text-slate-300">Total lockers</p>
            <p class="mt-4 text-4xl font-semibold tracking-tight tabular-nums">{{ $stats['total'] }}</p>
            <p class="mt-3 text-xs text-slate-300">Across {{ $locations->count() }} locations</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
            <div class="flex items-center justify-between gap-2">
                <p class="text-sm font-medium text-slate-600">Available</p>
                <span class="flex size-7 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700" aria-hidden="true">✓</span>
            </div>
            <p class="mt-3 text-4xl font-semibold tracking-tight text-slate-900 tabular-nums">{{ $stats['available'] }}</p>
            <p class="mt-3 text-xs text-emerald-700">Ready for the next session</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
            <div class="flex items-center justify-between gap-2">
                <p class="text-sm font-medium text-slate-600">In use</p>
                <span class="flex size-7 items-center justify-center rounded-lg bg-blue-50" aria-hidden="true"><span class="size-2 rounded-full bg-blue-600"></span></span>
            </div>
            <p class="mt-3 text-4xl font-semibold tracking-tight text-slate-900 tabular-nums">{{ $stats['in_use'] }}</p>
            <p class="mt-3 text-xs text-slate-500">{{ $stats['occupancy'] }}% of total capacity</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
            <div class="flex items-center justify-between gap-2">
                <p class="text-sm font-medium text-slate-600">Maintenance</p>
                <span class="flex size-7 items-center justify-center rounded-lg bg-amber-50 font-semibold text-amber-700" aria-hidden="true">!</span>
            </div>
            <p class="mt-3 text-4xl font-semibold tracking-tight text-slate-900 tabular-nums">{{ $stats['maintenance'] }}</p>
            <p class="mt-3 text-xs text-slate-500">Temporarily out of service</p>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- Line graph --}}
        <div class="xl:col-span-2 min-w-0 bg-white border border-slate-200 rounded-2xl p-5 shadow-sm sm:p-6">
            <div class="flex flex-wrap gap-3 items-start justify-between mb-6">
                <div>
                    <h2 class="text-base font-semibold text-slate-900">Session activity</h2>
                    <p class="mt-1 text-sm text-slate-500">Last 7 days · {{ $week->sum('count') }} sessions</p>
                </div>
                <span class="px-2.5 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-medium">
                    {{ $stats['today'] }} today
                </span>
            </div>

            @php
                $w = 640; $h = 200;
                $padL = 40; $padR = 28; $padT = 24; $padB = 28;
                $n = $week->count();
                $top = max(4, (int) ceil($week->max('count') / 4) * 4);
                $innerW = $w - $padL - $padR;
                $innerH = $h - $padT - $padB;
                $baseY = $padT + $innerH;

                $pts = $week->values()->map(function ($day, $i) use ($n, $padL, $padT, $innerW, $innerH, $top) {
                    return [
                        'x'     => round($padL + ($n > 1 ? $i * $innerW / ($n - 1) : $innerW / 2), 1),
                        'y'     => round($padT + (1 - $day['count'] / $top) * $innerH, 1),
                        'count' => $day['count'],
                        'label' => $day['label'],
                    ];
                })->all();

                // Smooth curve
                $d = 'M' . $pts[0]['x'] . ',' . $pts[0]['y'];
                for ($i = 1; $i < $n; $i++) {
                    $cx = round(($pts[$i - 1]['x'] + $pts[$i]['x']) / 2, 1);
                    $d .= ' C' . $cx . ',' . $pts[$i - 1]['y'] . ' ' . $cx . ',' . $pts[$i]['y'] . ' ' . $pts[$i]['x'] . ',' . $pts[$i]['y'];
                }
                $area = $d . ' L' . $pts[$n - 1]['x'] . ',' . $baseY . ' L' . $pts[0]['x'] . ',' . $baseY . ' Z';
            @endphp

            <svg viewBox="0 0 {{ $w }} {{ $h }}" class="w-full h-auto min-h-40 sm:min-h-52" role="img"
                 aria-label="Sessions per day for the last 7 days">
                <defs>
                    <linearGradient id="sessionsFill" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#2563eb" stop-opacity="0.25" />
                        <stop offset="100%" stop-color="#2563eb" stop-opacity="0" />
                    </linearGradient>
                </defs>

                {{-- Grid lines + y labels --}}
                @for ($i = 0; $i <= 4; $i++)
                    @php $y = $padT + $innerH - ($i / 4) * $innerH; @endphp
                    <line x1="{{ $padL }}" y1="{{ $y }}" x2="{{ $w - $padR }}" y2="{{ $y }}"
                          stroke="#e5e7eb" stroke-width="1" stroke-dasharray="{{ $i === 0 ? '0' : '3 4' }}" />
                    <text x="{{ $padL - 8 }}" y="{{ $y + 4 }}" text-anchor="end" font-size="11" fill="#9ca3af">
                        {{ $top / 4 * $i }}
                    </text>
                @endfor

                {{-- Area + line --}}
                <path d="{{ $area }}" fill="url(#sessionsFill)" />
                <path d="{{ $d }}" fill="none" stroke="#2563eb" stroke-width="2.5"
                      stroke-linecap="round" stroke-linejoin="round" />

                {{-- Dots, values, day labels --}}
                @foreach ($pts as $i => $p)
                    @php $isLast = $i === $n - 1; @endphp
                    <circle cx="{{ $p['x'] }}" cy="{{ $p['y'] }}" r="{{ $isLast ? 5 : 3.5 }}"
                            fill="{{ $isLast ? '#2563eb' : '#fff' }}" stroke="#2563eb" stroke-width="2">
                        <title>{{ $p['label'] }}: {{ $p['count'] }} sessions</title>
                    </circle>
                    <text x="{{ $p['x'] }}" y="{{ $p['y'] - 10 }}" text-anchor="middle"
                          font-size="11" font-weight="600" fill="#6b7280">{{ $p['count'] }}</text>
                    <text x="{{ $p['x'] }}" y="{{ $h - 8 }}" text-anchor="middle"
                          font-size="11" fill="{{ $isLast ? '#2563eb' : '#9ca3af' }}">{{ $p['label'] }}</text>
                @endforeach
            </svg>
        </div>

        {{-- Occupancy donut --}}
        <div class="min-w-0 bg-white border border-slate-200 rounded-2xl p-5 shadow-sm sm:p-6 flex flex-col">
            <h2 class="text-base font-semibold text-slate-900">Locker occupancy</h2>
            <p class="text-xs text-slate-500">Lockers currently in use</p>

            @php
                $r = 42;
                $circ = 2 * pi() * $r;
                $dash = $circ * $stats['occupancy'] / 100;
            @endphp

            <div class="relative mx-auto my-6 size-44">
                <svg viewBox="0 0 100 100" class="w-full h-full -rotate-90" aria-hidden="true">
                    <circle cx="50" cy="50" r="{{ $r }}" fill="none" stroke="#f3f4f6" stroke-width="10" />
                    <circle cx="50" cy="50" r="{{ $r }}" fill="none" stroke="#2563eb" stroke-width="10"
                            stroke-linecap="{{ $stats['occupancy'] > 0 ? 'round' : 'butt' }}"
                            stroke-dasharray="{{ round($dash, 2) }} {{ round($circ, 2) }}" />
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <span class="text-3xl font-bold text-slate-900">{{ $stats['occupancy'] }}%</span>
                    <span class="text-xs text-slate-500">{{ $stats['in_use'] }} / {{ $stats['total'] }}</span>
                </div>
            </div>

            <div class="mt-auto space-y-2 text-sm">
                <div class="flex items-center justify-between">
                    <span class="flex items-center gap-2 text-gray-500"><span class="w-2 h-2 rounded-full bg-emerald-500"></span>Available</span>
                    <span class="font-semibold text-slate-900">{{ $stats['available'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="flex items-center gap-2 text-gray-500"><span class="w-2 h-2 rounded-full bg-blue-600"></span>In use</span>
                    <span class="font-semibold text-slate-900">{{ $stats['in_use'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="flex items-center gap-2 text-gray-500"><span class="w-2 h-2 rounded-full bg-amber-500"></span>Maintenance</span>
                    <span class="font-semibold text-slate-900">{{ $stats['maintenance'] }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        {{-- Active sessions --}}
        <div class="min-w-0 bg-white border border-slate-200 rounded-2xl p-5 shadow-sm sm:p-6">
            <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
                <h2 class="text-base font-semibold text-slate-900">Active sessions</h2>
                <a href="{{ route('admin.usage.index') }}" class="rounded-md text-sm font-semibold text-blue-600 hover:text-blue-700 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-blue-600">View all</a>
            </div>
            <ul class="divide-y divide-gray-100">
                @forelse ($activeUsage as $usage)
                    <li class="flex items-center justify-between gap-3 py-4">
                        <div class="flex items-center gap-3 min-w-0">
                            <span class="flex items-center justify-center size-10 shrink-0 rounded-xl bg-blue-50 text-blue-700 text-sm font-semibold">
                                {{ strtoupper(substr($usage->user->name ?? '?', 0, 1)) }}
                            </span>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-slate-900 truncate">{{ $usage->user->name ?? '—' }}</p>
                                <p class="text-xs text-gray-500 truncate">
                                    {{ $usage->locker->name ?? '—' }} · {{ $usage->locker->location->name ?? '—' }}
                                </p>
                            </div>
                        </div>
                        <span class="shrink-0 px-2.5 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-medium">
                            {{ $usage->start_time->diffForHumans(null, true) }}
                        </span>
                    </li>
                @empty
                    <li class="py-8 text-center text-sm text-slate-500"><span class="block font-medium text-slate-700">No active sessions</span><span class="mt-1 block">Sessions will appear here when a locker is in use.</span></li>
                @endforelse
            </ul>
        </div>

        {{-- Locations --}}
        <div class="min-w-0 bg-white border border-slate-200 rounded-2xl p-5 shadow-sm sm:p-6">
            <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
                <h2 class="text-base font-semibold text-slate-900">Availability by location</h2>
                <a href="{{ route('admin.locations.index') }}" class="rounded-md text-sm font-semibold text-blue-600 hover:text-blue-700 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-blue-600">Manage</a>
            </div>
            <div class="space-y-3">
                @forelse ($locations as $location)
                    @php
                        $pct = $location->lockers_count > 0
                            ? round($location->in_use_count / $location->lockers_count * 100)
                            : 0;
                    @endphp
                    <div class="rounded-xl border border-slate-100 bg-slate-50/70 p-4">
                        <div class="flex items-center justify-between gap-3 text-sm">
                            <p class="font-semibold text-slate-900">{{ $location->name }}</p>
                            <span class="font-medium {{ $location->available_count > 0 ? 'text-emerald-700' : 'text-slate-500' }}">
                                {{ $location->available_count }} free
                            </span>
                        </div>
                        <div class="mt-2 h-2 w-full rounded-full bg-gray-100 overflow-hidden">
                            <div class="h-full rounded-full bg-blue-600" style="width: {{ $pct }}%"></div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">
                            {{ $location->in_use_count }} of {{ $location->lockers_count }} in use
                        </p>
                    </div>
                @empty
                    <p class="py-6 text-center text-sm text-slate-500">No locations yet. Add a location to get started.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
