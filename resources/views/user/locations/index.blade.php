@extends('layouts.app')

@section('title', 'Locations - Smart Locker')

@php
    $availableCount   = $lockers->where('status', 'Available')->count();
    $inUseCount       = $lockers->where('status', 'In Use')->count();
    $maintenanceCount = $lockers->where('status', 'Maintenance')->count();
    $locationCount    = $locations->count();
    $lockerCount      = $lockers->count();
    $popularLocations = $locations->take(3);
    $featured         = $locations->first();
    $sort             = request('sort', 'nearest');

    $sortedLocations = match ($sort) {
        'available' => $locations->sortByDesc(fn ($location) =>
                            $location->lockers->where('status', 'Available')->count()),
        'az'        => $locations->sortBy('name'),
        default     => $locations,
    };

    $stats = [
        ['label' => 'Available',   'dot' => 'bg-[var(--color-success)]', 'value' => $availableCount],
        ['label' => 'In Use',      'dot' => 'bg-[var(--color-primary)]', 'value' => $inUseCount],
        ['label' => 'Maintenance', 'dot' => 'bg-[var(--color-warning)]', 'value' => $maintenanceCount],
        ['label' => 'Location',    'dot' => 'bg-[#8b5cf6]',              'value' => $locationCount],
    ];
@endphp

@section('content')
    <section class="relative overflow-hidden min-h-[320px] bg-[var(--color-primary-dark)] text-white flex items-center justify-center">
        <div class="pointer-events-none absolute -top-24 -right-24 h-72 w-72 rounded-full bg-white/10 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-24 -left-24 h-72 w-72 rounded-full bg-white/10 blur-3xl"></div>

        <div class="relative z-[5] mx-auto max-w-3xl mt-[60px] px-6 pt-[70px] pb-[90px] text-center">
            <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-xs font-bold tracking-wide">
                📍 3 LOCATIONS · LIVE AVAILABILITY
            </span>

            <h1 class="mt-[22px] mb-[18px] text-[clamp(36px,5vw,56px)] font-extrabold leading-[1.05] tracking-[-0.04em] text-white">
                All Locations
            </h1>

            <p class="mx-auto max-w-[650px] text-base leading-[1.7] text-[#cbd5e1]">
                Browse every Smart Locker location, check live availability,
                and reserve your locker in seconds.
            </p>
        </div>

        <svg class="absolute bottom-0 left-0 h-[100px] w-full fill-white" viewBox="0 0 1440 100" preserveAspectRatio="none">
            <path d="M0,60 C240,100 480,20 720,40 C960,60 1200,100 1440,60 L1440,100 L0,100 Z"></path>
        </svg>
    </section>

    <section class="bg-[var(--color-bg)] px-6 pb-[70px]">
        <div class="relative z-10 mx-auto mt-[-65px] grid w-full max-w-7xl grid-cols-4 gap-4 max-md:grid-cols-2 max-[480px]:gap-2.5">
            @foreach ($stats as $stat)
                <div class="rounded-[14px] border-2 border-[var(--color-border)] bg-[var(--color-card)] px-[22px] py-[26px] shadow-[0_8px_25px_rgba(15,23,42,0.05)] max-[480px]:p-[17px]">
                    <div class="flex items-center gap-2 text-[13px] font-semibold text-[var(--color-body)]">
                        <span class="h-2 w-2 rounded-full {{ $stat['dot'] }}"></span>
                        {{ $stat['label'] }}
                    </div>
                    <strong class="mt-2 block text-[30px] font-extrabold text-[var(--color-heading)] max-[480px]:text-[25px]">{{ $stat['value'] }}</strong>
                </div>
            @endforeach
        </div>
    </section>

    <section class="mx-auto max-w-[1280px] pb-16">
        <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-wide text-[var(--color-primary)]">LOCATIONS</span>
                <h2 class="mt-1 text-2xl font-bold text-[var(--color-heading)]">All locations</h2>
                <p class="mt-1 text-sm text-[var(--color-muted)]">3 locations available across the city</p>
            </div>

            <div class="flex items-center gap-2 text-sm text-[var(--color-muted)]">
                <span>Sort:</span>

                <select class="rounded-lg border border-[var(--color-border)] bg-white px-3 py-2 text-sm text-[var(--color-body)]">
                    <option>Nearest</option>
                    <option>Most available</option>
                    <option>A-Z</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3.5 max-md:grid-cols-1">
             @forelse ($sortedLocations as $location)
                @php
                    $total       = $location->lockers->count();
                    $available   = $location->lockers->where('status', 'Available')->count();
                    $inUse       = $location->lockers->where('status', 'In Use')->count();
                    $maintenance = $location->lockers->where('status', 'Maintenance')->count();
                    $percent     = $total > 0 ? (int) round(($available / $total) * 100) : 0;

                    if ($total === 0 || ($available === 0 && $inUse === 0 && $maintenance > 0)) {
                        $badge = 'maintenance';
                        $badgeLabel = 'Maintenance';
                    } elseif ($available === 0) {
                        $badge = 'full';
                        $badgeLabel = 'Full';
                    } else {
                        $badge = 'open';
                        $badgeLabel = 'Open';
                    }

                    $badgeClass = [
                        'open'        => 'bg-[#f0fdf4] text-[#15803d]',
                        'full'        => 'bg-[#fef2f2] text-[#dc2626]',
                        'maintenance' => 'bg-[#fffbeb] text-[#b45309]',
                    ][$badge];
                    $dotClass = [
                        'open'        => 'bg-[var(--color-success)]',
                        'full'        => 'bg-[var(--color-danger)]',
                        'maintenance' => 'bg-[var(--color-warning)]',
                    ][$badge];
                @endphp

                <article class="grid grid-cols-[1fr_180px] gap-[30px] rounded-2xl border-2 border-[var(--color-border)] bg-[var(--color-card)] p-6 transition duration-200 hover:-translate-y-px hover:border-blue-200 hover:shadow-[0_12px_30px_rgba(15,23,42,0.07)] max-[900px]:grid-cols-1 max-[480px]:p-[18px]">
                    <div>
                        <div class="flex items-start justify-between gap-5 max-[480px]:flex-col">
                            <div class="flex items-center gap-[13px]">
                                <div class="flex h-[42px] w-[42px] shrink-0 items-center justify-center rounded-[11px] bg-[var(--color-primary-light)] text-[var(--color-primary)]">
                                    <svg class="h-[21px] w-[21px] stroke-current stroke-[1.8]" viewBox="0 0 24 24" fill="none">
                                        <path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"></path>
                                        <circle cx="12" cy="10" r="2.5"></circle>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="mb-1 text-base font-bold text-[var(--color-heading)]">{{ $location->name }}</h3>
                                    <p class="m-0 text-xs text-[var(--color-muted)]">{{ $location->address }}</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1.5 text-[11px] font-bold {{ $badgeClass }}">
                                <span class="h-1.5 w-1.5 rounded-full {{ $dotClass }}"></span>
                                {{ $badgeLabel }}
                            </span>
                        </div>

                        <div class="mt-5 flex flex-wrap gap-2">
                            <span class="inline-flex items-center gap-1.5 rounded-[7px] bg-[#f0fdf4] px-[9px] py-1.5 text-[11px] font-semibold text-[#15803d]">
                                <span class="h-1.5 w-1.5 rounded-full bg-[var(--color-success)]"></span>
                                {{ $available }} Available
                            </span>
                            <span class="inline-flex items-center gap-1.5 rounded-[7px] bg-[var(--color-primary-light)] px-[9px] py-1.5 text-[11px] font-semibold text-[var(--color-primary)]">
                                <span class="h-1.5 w-1.5 rounded-full bg-[var(--color-primary)]"></span>
                                {{ $inUse }} In Use
                            </span>
                            @if ($maintenance > 0)
                                <span class="inline-flex items-center gap-1.5 rounded-[7px] bg-[#fffbeb] px-[9px] py-1.5 text-[11px] font-semibold text-[#b45309]">
                                    <span class="h-1.5 w-1.5 rounded-full bg-[var(--color-warning)]"></span>
                                    {{ $maintenance }} Maintenance
                                </span>
                            @endif
                        </div>

                        <div class="mt-[18px]">
                            <div class="mb-[7px] flex items-center justify-between text-[11px] text-[var(--color-muted)]">
                                <span>Availability</span>
                                <strong class="font-semibold text-[var(--color-body)]">{{ $available }} / {{ $total }} lockers free</strong>
                            </div>
                            <div class="h-1.5 w-full overflow-hidden rounded-full bg-slate-200">
                                <div class="h-full rounded-full bg-[var(--color-success)]" style="width: {{ $percent }}%;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col items-end justify-center border-l border-[var(--color-border)] pl-[25px] text-right max-[900px]:items-start max-[900px]:border-l-0 max-[900px]:border-t max-[900px]:pt-5 max-[900px]:pl-0 max-[900px]:text-left max-[480px]:w-full">
                        <span class="text-[11px] text-[var(--color-muted)]">Starting from</span>
                        <strong class="mt-[3px] text-[21px] text-[var(--color-heading)]">Free</strong>
                        <small class="text-[10px] text-[var(--color-muted)]">first 2 hours</small>

                        @if ($badge === 'full')
                            <button type="button" disabled class="mt-3.5 flex w-full max-w-[180px] cursor-not-allowed items-center justify-center gap-[7px] rounded-[9px] border-0 bg-slate-200 px-3 py-2.5 text-xs font-semibold text-slate-400 max-[480px]:max-w-none">
                                Notify Me
                            </button>
                        @else
                            <a href="{{ route('user.locations.show', $location) }}" class="mt-3.5 flex w-full max-w-[180px] items-center justify-center gap-[7px] rounded-[9px] bg-[var(--color-primary)] px-3 py-2.5 text-xs font-semibold text-white no-underline transition duration-200 hover:bg-[var(--color-primary-hover)] max-[480px]:max-w-none">
                                View Lockers
                                <svg class="h-3.5 w-3.5 stroke-current stroke-2" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 12h14"></path>
                                    <path d="m13 6 6 6-6 6"></path>
                                </svg>
                            </a>
                        @endif
                    </div>
                </article>
            @empty
                <p class="col-span-2 text-sm text-[var(--color-muted)]">No locations found.</p>
            @endforelse
        </div>
    </section>
@endsection