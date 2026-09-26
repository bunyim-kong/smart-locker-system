@extends('layouts.app')

@section('title', $location->name . ' - Smart Locker')

@section('content')
    @php
        $available   = $location->lockers->where('status', 'Available')->count();
        $inUse       = $location->lockers->where('status', 'In Use')->count();
        $maintenance = $location->lockers->where('status', 'Maintenance')->count();
        $total       = $location->lockers->count();

        $statusText = [
            'Available'   => 'text-[#15803d]',
            'In Use'      => 'text-[var(--color-primary)]',
            'Maintenance' => 'text-[#b45309]',
        ];
        $statusDot = [
            'Available'   => 'bg-[var(--color-success)]',
            'In Use'      => 'bg-[var(--color-primary)]',
            'Maintenance' => 'bg-[var(--color-warning)]',
        ];
        $statusLabel = [
            'Available'   => 'Available',
            'In Use'      => 'In Use',
            'Maintenance' => 'Maintenance',
        ];
    @endphp

    <section class="relative overflow-hidden min-h-[320px] bg-[var(--color-primary-dark)] text-white flex items-center justify-center">
        <div class="pointer-events-none absolute -top-24 -right-24 h-72 w-72 rounded-full bg-white/10 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-24 -left-24 h-72 w-72 rounded-full bg-white/10 blur-3xl"></div>

        <div class="relative z-[5] mx-auto max-w-[1280px] mt-[60px] px-6 pt-[70px] pb-[90px] text-center">
            <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-xs font-bold tracking-wide">
                📍 {{ strtoupper($location->name) }} · {{ strtoupper($location->address) }}
            </span>

            <h1 class="mt-[22px] mb-[18px] text-[clamp(36px,5vw,56px)] max-[600px]:text-[32px] font-extrabold leading-[1.05] tracking-[-0.04em] text-white">
                {{ $location->name }}
            </h1>

            <p class="mx-auto max-w-[650px] text-base leading-[1.7] text-[#cbd5e1]">
                {{ $location->address }}
            </p>
        </div>

        <svg class="absolute bottom-0 left-0 h-[100px] w-full fill-white" viewBox="0 0 1440 100" preserveAspectRatio="none">
            <path d="M0,60 C240,100 480,20 720,40 C960,60 1200,100 1440,60 L1440,100 L0,100 Z"></path>
        </svg>
    </section>

    <section class="mx-auto max-w-[1280px] pb-[90px]">

        <div class="relative z-[7] mx-auto -mt-[65px] mb-10 grid grid-cols-4 gap-4 max-[768px]:grid-cols-2 max-[768px]:gap-[10px]">
            <div class="flex flex-col gap-2 rounded-2xl border-2 border-[var(--color-border)] bg-[var(--color-card)] p-5">
                <div class="inline-flex items-center gap-2 text-xs font-semibold text-[var(--color-muted)]">
                    <span class="h-2 w-2 rounded-full bg-[var(--color-success)]"></span>
                    Available
                </div>
                <strong class="text-2xl font-bold text-[var(--color-heading)]">{{ $available }}</strong>
            </div>

            <div class="flex flex-col gap-2 rounded-2xl border-2 border-[var(--color-border)] bg-[var(--color-card)] p-5">
                <div class="inline-flex items-center gap-2 text-xs font-semibold text-[var(--color-muted)]">
                    <span class="h-2 w-2 rounded-full bg-[var(--color-primary)]"></span>
                    In Use
                </div>
                <strong class="text-2xl font-bold text-[var(--color-heading)]">{{ $inUse }}</strong>
            </div>

            <div class="flex flex-col gap-2 rounded-2xl border-2 border-[var(--color-border)] bg-[var(--color-card)] p-5">
                <div class="inline-flex items-center gap-2 text-xs font-semibold text-[var(--color-muted)]">
                    <span class="h-2 w-2 rounded-full bg-[var(--color-warning)]"></span>
                    Maintenance
                </div>
                <strong class="text-2xl font-bold text-[var(--color-heading)]">{{ $maintenance }}</strong>
            </div>

            <div class="flex flex-col gap-2 rounded-2xl border-2 border-[var(--color-border)] bg-[var(--color-card)] p-5">
                <div class="inline-flex items-center gap-2 text-xs font-semibold text-[var(--color-muted)]">
                    <span class="h-2 w-2 rounded-full bg-slate-400"></span>
                    Total Lockers
                </div>
                <strong class="text-2xl font-bold text-[var(--color-heading)]">{{ $total }}</strong>
            </div>
        </div>

        <div class="mb-7 flex flex-wrap items-center justify-end gap-5 rounded-[14px] border-2 border-[var(--color-border)] bg-[var(--color-card)] px-5 py-4 max-[768px]:flex-col max-[768px]:items-start">
            <div class="flex flex-wrap items-center gap-2">
                <span class="mr-1 text-xs font-semibold text-[var(--color-muted)]">Status:</span>
                <button class="rounded-full border border-[var(--color-primary)] bg-[var(--color-primary)] px-[14px] py-1.5 text-xs font-semibold text-white">All</button>
                <button class="rounded-full border border-[var(--color-border)] bg-white px-[14px] py-1.5 text-xs font-semibold text-[var(--color-body)] transition-all duration-200 ease-out hover:border-[var(--color-primary)] hover:text-[var(--color-primary)]">Available</button>
                <button class="rounded-full border border-[var(--color-border)] bg-white px-[14px] py-1.5 text-xs font-semibold text-[var(--color-body)] transition-all duration-200 ease-out hover:border-[var(--color-primary)] hover:text-[var(--color-primary)]">In Use</button>
                <button class="rounded-full border border-[var(--color-border)] bg-white px-[14px] py-1.5 text-xs font-semibold text-[var(--color-body)] transition-all duration-200 ease-out hover:border-[var(--color-primary)] hover:text-[var(--color-primary)]">Maintenance</button>
            </div>
        </div>

        {{-- Lockers grid --}}
        <div class="grid grid-cols-3 gap-4 pb-10 max-[1280px]:grid-cols-2 max-[600px]:grid-cols-1">
            @forelse ($location->lockers as $locker)
                <article class="flex flex-col overflow-hidden rounded-2xl border-2 border-[var(--color-border)] bg-[var(--color-card)] transition-all duration-200 ease-out hover:-translate-y-0.5 hover:shadow-[0_12px_30px_rgba(15,23,42,0.07)]">
                    <div class="flex items-center justify-between border-b border-[var(--color-border)] bg-[#f8fafc] px-[18px] py-[14px]">
                        <span class="text-sm font-extrabold tracking-[0.02em] text-[var(--color-heading)]">Locker {{ $locker->name }}</span>
                        <span class="inline-flex items-center rounded-md bg-[var(--color-primary-light)] px-2 py-1 text-[10px] font-semibold uppercase tracking-wide text-[var(--color-primary)]">{{ ucfirst($locker->size) }}</span>
                    </div>

                    <div class="flex flex-1 gap-4 p-[18px]">
                        <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-xl bg-[var(--color-primary-light)] text-[var(--color-primary)]">
                            <svg class="h-[30px] w-[30px] stroke-current stroke-[1.5]" viewBox="0 0 24 24" fill="none">
                                <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                                <path d="M3 9h18"></path>
                                <path d="M9 3v18"></path>
                            </svg>
                        </div>

                        <div class="flex flex-1 flex-col justify-center gap-2">
                            <div class="flex items-center justify-between gap-[10px]">
                                <span class="text-[11px] text-[var(--color-muted)]">Locker ID</span>
                                <strong class="text-xs font-semibold text-[var(--color-heading)]">#{{ $locker->id }}</strong>
                            </div>
                            <div class="flex items-center justify-between gap-[10px]">
                                <span class="text-[11px] text-[var(--color-muted)]">Location Name</span>
                                <strong class="text-xs font-semibold text-[var(--color-heading)]">{{ $location->name }}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between gap-3 border-t border-[var(--color-border)] bg-[#f8fafc] px-[18px] py-[14px]">
                        <span class="inline-flex items-center gap-1.5 text-[11px] font-bold {{ $statusText[$locker->status] }}">
                            <span class="h-[10px] w-[10px] rounded-full {{ $statusDot[$locker->status] }}"></span>
                            {{ $statusLabel[$locker->status] }}
                        </span>

                        @if ($locker->status === 'available')
                            <a href="{{ route('lockers.show', $locker) }}" class="rounded-lg bg-[var(--color-primary)] px-4 py-2 text-xs font-semibold text-white transition-colors duration-200 ease-out hover:bg-[var(--color-primary-hover)]">
                                Reserve
                            </a>
                        @else
                            <button class="cursor-not-allowed rounded-lg bg-[#e2e8f0] px-4 py-2 text-xs font-semibold text-[#94a3b8]" disabled>
                                Unavailable
                            </button>
                        @endif
                    </div>
                </article>
            @empty
                <p class="col-span-full text-center text-sm text-[var(--color-muted)]">No lockers at this location yet.</p>
            @endforelse
        </div>

    </section>
@endsection