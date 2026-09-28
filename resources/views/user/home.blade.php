@extends('layouts.app')

@section('title', 'Home - Smart Locker')

@php
    $availableCount   = $lockers->where('status', 'Available')->count();
    $inUseCount       = $lockers->where('status', 'In Use')->count();
    $maintenanceCount = $lockers->where('status', 'Maintenance')->count();
    $locationCount    = $locations->count();
    $lockerCount      = $lockers->count();
    $popularLocations = $locations->take(3);
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

    <section class="relative flex items-center justify-center overflow-hidden bg-[var(--color-primary-dark)] text-white">
        <div class="pointer-events-none absolute -top-[150px] -right-20 h-[300px] w-[300px] rounded-full bg-[rgba(13,110,253,0.18)]"></div>
        <div class="pointer-events-none absolute -bottom-[250px] -left-40 h-[380px] w-[380px] rounded-full bg-[rgba(96,165,250,0.1)]"></div>

        <svg class="absolute right-[8%] top-[15%] h-[120px] w-[120px] text-white/[0.07]" viewBox="0 0 120 120" fill="none">
            <path class="stroke-current" d="M20 60a30 30 0 0 1 30 30"></path>
            <path class="stroke-current" d="M20 40a50 50 0 0 1 50 50"></path>
            <path class="stroke-current" d="M20 20a70 70 0 0 1 70 70"></path>
        </svg>

        <div class="relative z-[5] mx-auto w-full max-w-7xl px-4 pb-24 pt-10 text-center sm:px-6 sm:pb-28 lg:pt-20">

            <h1 class="mb-[18px] text-[clamp(42px,7vw,72px)] font-extrabold leading-[1.05] tracking-[-0.04em] text-white max-md:text-[44px] max-[480px]:text-[38px]">
                Find a locker.<br>
                <span class="text-blue-400">Store it. Forget it.</span>
            </h1>

            <p class="mx-auto max-w-[650px] text-[17px] leading-[1.7] text-slate-300 max-md:text-[15px]">
                Search nearby locations, see live locker availability,
                and reserve in seconds — no keys, no waiting.
            </p>

            <div class="mx-auto mt-6 sm:mt-[35px] max-w-[760px]">
                <form action="{{ url('/') }}" method="GET" class="flex items-center rounded-[14px] bg-white p-1.5 shadow-[0_20px_45px_rgba(0,0,0,0.2)] max-md:flex-col max-md:p-2">
                    <div class="flex min-w-0 flex-1 items-center gap-3 px-[15px] max-md:w-full">
                        <svg class="h-[21px] w-[21px] shrink-0 stroke-[#94a3b8] stroke-2" viewBox="0 0 24 24" fill="none">
                            <circle cx="11" cy="11" r="7"></circle>
                            <path d="M21 21l-4.3-4.3"></path>
                        </svg>
                        <input
                            type="text"
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="Search by location name, city, or address..."
                            class="h-10 w-full min-w-0 border-0 bg-transparent text-base sm:text-sm text-slate-700 outline-none placeholder:text-slate-400 max-md:h-12"
                        >
                    </div>
                    <button type="submit" class="h-[50px] cursor-pointer rounded-[10px] border-0 bg-[var(--color-primary)] px-[26px] text-sm font-semibold text-white transition duration-200 hover:-translate-y-px hover:bg-[var(--color-primary-hover)] max-md:w-full">
                        Search
                    </button>
                </form>

                <div class="mt-[15px] flex flex-wrap items-center justify-center gap-2 max-[480px]:justify-start">
                    <span class="mr-[3px] text-xs text-slate-400">Popular:</span>
                    <a href="{{ url('/') }}" class="rounded-full border border-white/[0.15] bg-white/[0.06] px-[11px] py-[5px] text-xs text-slate-300 no-underline transition duration-200 hover:bg-white/[0.12] hover:text-white">Near me</a>
                    @foreach ($popularLocations as $popular)
                        <a href="{{ url('/?q=' . urlencode($popular->name)) }}" class="rounded-full border border-white/[0.15] bg-white/[0.06] px-[11px] py-[5px] text-xs text-slate-300 no-underline transition duration-200 hover:bg-white/[0.12] hover:text-white">
                            {{ $popular->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <svg class="absolute right-0 bottom-[-1px] left-0 h-[90px] w-full" viewBox="0 0 1440 100" preserveAspectRatio="none">
            <path class="fill-[var(--color-bg)]" d="M0,60 C240,100 480,20 720,40 C960,60 1200,100 1440,60 L1440,100 L0,100 Z"></path>
        </svg>
    </section>

    <!-- stat card -->
    <section class="bg-[var(--color-bg)] px-4 sm:px-6 pb-10 sm:pb-14 lg:pb-[70px]">
        <div class="relative z-10 mx-auto mt-[-65px] grid w-full max-w-7xl grid-cols-4 gap-4 max-md:grid-cols-2 max-[480px]:gap-2.5">
            @foreach ($stats as $stat)
                <div class="rounded-[14px] border-2 border-[var(--color-border)] bg-[var(--color-card)] px-[22px] py-[26px] shadow-[0_8px_25px_rgba(15,23,42,0.05)] max-[480px]:p-3">
                    <div class="flex items-center gap-2 text-[13px] font-semibold text-[var(--color-body)]">
                        <span class="h-2 w-2 shrink-0 rounded-full {{ $stat['dot'] }}"></span>
                        {{ $stat['label'] }}
                    </div>
                    <strong class="mt-2 block text-[30px] font-extrabold text-[var(--color-heading)] max-[480px]:text-[25px]">{{ $stat['value'] }}</strong>
                </div>
            @endforeach
        </div>
    </section>


    <section class="mx-auto w-full max-w-7xl px-4 sm:px-6 pb-10 sm:pb-14 lg:pb-[70px]">
        <div class="mb-[30px] flex items-end justify-between gap-[30px] max-md:flex-col max-md:items-start">
            <div>
                <span class="mb-2 block text-[11px] font-extrabold tracking-[0.12em] text-[var(--color-primary)]">LOCATIONS</span>
                <h2 class="m-0 text-[30px] font-extrabold leading-[1.2] tracking-[-0.025em] text-[var(--color-heading)]">Locations near you</h2>
                <p class="mt-2 text-sm text-[var(--color-muted)]">This is some location that is near you</p>
            </div>
            <form method="GET" action="{{ url('/') }}" class="flex items-center gap-2 text-[13px] text-[var(--color-muted)]">
                @if (request('q'))
                    <input type="hidden" name="q" value="{{ request('q') }}">
                @endif
                <span>Sort:</span>
                <select name="sort" onchange="this.form.submit()" class="cursor-pointer rounded-lg border border-[var(--color-border)] bg-white py-[9px] pl-3 pr-[30px] text-[var(--color-body)] outline-none">
                    <option value="nearest" @selected($sort === 'nearest')>Nearest</option>
                    <option value="available" @selected($sort === 'available')>Most available</option>
                </select>
            </form>
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

                <article class="grid min-w-0 grid-cols-1 gap-5 rounded-2xl border-2 border-[var(--color-border)] bg-[var(--color-card)] p-6 transition duration-200 hover:-translate-y-px hover:border-blue-200 hover:shadow-[0_12px_30px_rgba(15,23,42,0.07)] max-[480px]:p-[18px]">
                    <div>
                        <div class="flex flex-wrap items-start justify-between gap-3">
                            <div class="flex min-w-0 flex-1 items-center gap-[13px]">
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
                            <span class="inline-flex shrink-0 items-center gap-1.5 rounded-full px-2.5 py-1.5 text-[11px] font-bold {{ $badgeClass }}">
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

                    <div class="flex flex-col items-start border-t border-[var(--color-border)] pt-5 text-left">
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
                <p class="col-span-full text-sm text-[var(--color-muted)]">No locations found.</p>
            @endforelse
        </div>

        <div class="mt-7 text-center">
            <a href="{{ route('user.locations.index') }}" class="inline-flex items-center gap-[7px] text-[13px] font-semibold text-[var(--color-primary)] no-underline hover:text-[var(--color-primary-hover)]">
                View all locations
                <svg class="h-[15px] w-[15px] stroke-current stroke-2" viewBox="0 0 24 24" fill="none">
                    <path d="M5 12h14"></path>
                    <path d="m13 6 6 6-6 6"></path>
                </svg>
            </a>
        </div>
    </section>

    <section aria-labelledby="locker-banner-title" class="relative overflow-hidden bg-[var(--color-primary-dark)] px-4 py-10 sm:px-6 sm:py-20">
        <div aria-hidden="true" class="pointer-events-none absolute -right-20 -top-24 h-72 w-72 rounded-full border border-[var(--color-primary)]/30"></div>
        <div aria-hidden="true" class="pointer-events-none absolute -bottom-32 -left-16 h-72 w-72 rounded-full border border-[var(--color-primary)]/30"></div>
        <div class="relative mx-auto flex max-w-3xl flex-col items-center gap-4 text-center">
            <span class="text-[11px] font-bold uppercase tracking-[0.16em] text-[var(--color-footer-text)]">Smart Locker</span>
            <h2 id="locker-banner-title" class="m-0 text-3xl font-extrabold leading-tight tracking-tight text-[var(--color-btn-text)] sm:text-4xl">Find your next locker.</h2>
            <p class="m-0 max-w-xl text-sm leading-7 text-[var(--color-footer-text)] sm:text-base">Browse our locations and check locker availability before you visit.</p>
        </div>
    </section>

    <section class="mx-auto w-full max-w-7xl px-4 sm:px-6 pb-10 sm:pb-14 lg:pb-[70px] pt-10 sm:pt-[60px]">
        <div class="mb-10 text-center">
            <span class="mb-2 block text-[11px] font-extrabold tracking-[0.12em] text-[var(--color-primary)]">HOW IT WORKS</span>
            <h2 class="m-0 text-[30px] font-extrabold leading-[1.2] tracking-[-0.025em] text-[var(--color-heading)]">Three taps and you're done</h2>
            <p class="mt-2 text-sm text-[var(--color-muted)]">No app download. No account needed for one-time use.</p>
        </div>

        <div class="grid grid-cols-3 gap-5 max-md:grid-cols-1">
            <article class="relative rounded-2xl border border-[var(--color-border)] bg-white p-[30px] text-center">
                <div class="mx-auto mb-5 flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[var(--color-primary-light)] text-lg font-extrabold text-[var(--color-primary)]">1</div>
                <h3 class="mb-2.5 text-base font-bold text-[var(--color-heading)]">Find a Locker</h3>
                <p class="m-0 text-[13px] leading-[1.7] text-[var(--color-body)]">Browse locations and check which lockers are available before you visit.</p>
            </article>
            <article class="relative rounded-2xl border border-[var(--color-border)] bg-white p-[30px] text-center">
                <div class="mx-auto mb-5 flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[var(--color-primary-light)] text-lg font-extrabold text-[var(--color-primary)]">2</div>
                <h3 class="mb-2.5 text-base font-bold text-[var(--color-heading)]">Get Your Code</h3>
                <p class="m-0 text-[13px] leading-[1.7] text-[var(--color-body)]">Reserve the locker and receive a 6-digit one-time code instantly.</p>
            </article>
            <article class="relative rounded-2xl border border-[var(--color-border)] bg-white p-[30px] text-center">
                <div class="mx-auto mb-5 flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[var(--color-primary-light)] text-lg font-extrabold text-[var(--color-primary)]">3</div>
                <h3 class="mb-2.5 text-base font-bold text-[var(--color-heading)]">Store & Go</h3>
                <p class="m-0 text-[13px] leading-[1.7] text-[var(--color-body)]">Enter the code on the locker keypad, drop your stuff, and go.</p>
            </article>
        </div>

        <div class="mt-[30px] text-center">
            <a href="/how-to-use" class="inline-flex items-center gap-[7px] text-[13px] font-semibold text-[var(--color-primary)] no-underline">
                Read the full guide
                <svg class="h-[15px] w-[15px] stroke-current" viewBox="0 0 24 24" fill="none">
                    <path d="M5 12h14"></path>
                    <path d="m13 6 6 6-6 6"></path>
                </svg>
            </a>
        </div>
    </section>

    <section class="mx-auto w-full max-w-7xl px-4 sm:px-6 pb-10 sm:pb-14 lg:pb-[70px]">
        <div class="grid grid-cols-3 gap-4 max-md:grid-cols-1">
            <div class="flex items-center gap-3.5 rounded-2xl border border-[var(--color-border)] bg-white p-5">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#f0fdf4] text-[var(--color-success)]">
                    <svg class="h-6 w-6 stroke-current stroke-[1.8]" viewBox="0 0 24 24" fill="none">
                        <path d="M12 3 20 6v5c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V6l8-3Z"></path>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                </div>
                <div>
                    <strong class="block text-sm text-[var(--color-heading)]">Encrypted Codes</strong>
                    <span class="text-xs text-[var(--color-muted)]">One-time use only</span>
                </div>
            </div>
            <div class="flex items-center gap-3.5 rounded-2xl border border-[var(--color-border)] bg-white p-5">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[var(--color-primary-light)] text-[var(--color-primary)]">
                    <svg class="h-6 w-6 stroke-current stroke-[1.8]" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="9"></circle>
                        <path d="M12 7v5l3 2"></path>
                    </svg>
                </div>
                <div>
                    <strong class="block text-sm text-[var(--color-heading)]">24/7 Access</strong>
                    <span class="text-xs text-[var(--color-muted)]">Anytime, any day</span>
                </div>
            </div>
            <div class="flex items-center gap-3.5 rounded-2xl border border-[var(--color-border)] bg-white p-5">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#fffbeb] text-[var(--color-warning)]">
                    <svg class="h-6 w-6 stroke-current stroke-[1.8]" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="9"></circle>
                        <path d="m8 12 2.5 2.5L16 9"></path>
                    </svg>
                </div>
                <div>
                    <strong class="block text-sm text-[var(--color-heading)]">Free First 2 Hours</strong>
                    <span class="text-xs text-[var(--color-muted)]">No card required</span>
                </div>
            </div>
        </div>
    </section>
@endsection