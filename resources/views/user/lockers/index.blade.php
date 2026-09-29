@extends('layouts.app')

@section('title', 'My Lockers - Smart Locker')

@section('content')
<section class="mx-auto w-full max-w-7xl px-[18px] pb-10 pt-6 sm:px-6 sm:pb-16 lg:pt-10">
    <div class="mb-6 flex flex-col items-start gap-3 sm:mb-8 sm:flex-row sm:flex-wrap sm:items-center sm:justify-between sm:gap-4">
        <div>
            <p class="text-xs font-semibold uppercase tracking-widest text-[var(--color-primary)]">Your storage</p>
            <h1 class="mt-2 text-3xl font-bold text-[var(--color-heading)]">My Lockers</h1>
            <p class="mt-2 text-sm text-[var(--color-body)]">Find your assigned lockers, open their locations, and manage each session here.</p>
        </div>
        <a href="{{ route('user.locations.index') }}" class="font-semibold text-[var(--color-primary)] hover:underline">Browse locations &rarr;</a>
    </div>
    @if (session('success'))
        <p role="status" class="mb-6 rounded-xl border border-[var(--color-border)] bg-[var(--color-primary-light)] p-4 text-sm text-[var(--color-heading)]">{{ session('success') }}</p>
    @endif
    @if ($errors->any())
        <div role="alert" class="mb-6 rounded-xl border border-[var(--color-danger)] p-4 text-sm text-[var(--color-heading)]">{{ $errors->first() }}</div>
    @endif

    <div class="flex flex-col gap-6">
    @forelse ($activeUsages as $activeUsage)
        @php
            $location = $activeUsage->locker->location;
            $mapLink = $location->map_link;
            $hasMapLink = filter_var($mapLink, FILTER_VALIDATE_URL)
                && in_array(strtolower(parse_url($mapLink, PHP_URL_SCHEME) ?? ''), ['http', 'https'], true);
            $mapEmbedUrl = 'https://www.google.com/maps?q='.urlencode($location->address).'&output=embed';
        @endphp
        <article class="grid min-w-0 overflow-hidden rounded-2xl border border-[var(--color-border)] bg-[var(--color-card)] lg:grid-cols-2">
            <div class="flex min-w-0 flex-col p-6 sm:p-8">
                <div class="flex flex-wrap items-start justify-between gap-3">
                    <div class="min-w-0">
                        <p class="text-xs font-semibold uppercase tracking-widest text-[var(--color-primary)]">Your active locker</p>
                        <h2 class="mt-2 text-2xl font-bold text-[var(--color-heading)]">Locker {{ $activeUsage->locker->name }}</h2>
                        <p class="mt-2 text-sm leading-6 text-[var(--color-body)]">{{ $location->name }} &middot; {{ $location->address }}</p>
                    </div>
                    <span class="shrink-0 rounded-full bg-[var(--color-primary-soft)] px-3 py-1 text-xs font-semibold text-[var(--color-primary)]">Assigned to you</span>
                </div>

                <div class="my-7 rounded-2xl bg-[var(--color-primary-light)] p-5 text-center sm:p-7">
                    <p class="text-sm font-medium text-[var(--color-heading)]">Your access code</p>
                    @if ($activeUsage->access_code)
                        <p class="mt-3 max-w-full overflow-x-auto whitespace-nowrap rounded-xl bg-white px-4 py-4 font-mono text-3xl font-bold tracking-[0.12em] text-[var(--color-heading)] sm:px-6 sm:text-4xl sm:tracking-[0.2em]">{{ $activeUsage->access_code }}</p>
                        <p class="mx-auto mt-3 max-w-sm text-sm text-[var(--color-body)]">Keep this code private. You can return to this page while your locker is in use.</p>
                    @else
                        <p class="mt-3 text-sm text-[var(--color-body)]">No code is available for this existing session. Contact an administrator for assistance.</p>
                    @endif
                    <p class="mt-4 text-xs text-[var(--color-body)]">Started {{ $activeUsage->start_time->format('M j, Y · g:i A') }}</p>
                </div>

                <form action="{{ route('user.lockers.finish', $activeUsage) }}" method="POST" class="mt-auto flex flex-col gap-4 border-t border-[var(--color-border)] pt-6">
                    @csrf
                    <label class="flex items-start gap-3 text-sm text-[var(--color-body)]">
                        <input type="checkbox" required class="mt-1 accent-[var(--color-primary)]">
                        <span>I have collected my belongings and am ready to release this locker.</span>
                    </label>
                    <button type="submit" class="rounded-xl bg-[var(--color-btn-primary)] px-5 py-3 text-sm font-semibold text-[var(--color-btn-text)] hover:bg-[var(--color-btn-primary-hover)] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[var(--color-primary)]">Finish use</button>
                </form>
            </div>

            <div class="flex min-h-[360px] flex-col border-t border-[var(--color-border)] bg-slate-100 lg:min-h-[520px] lg:border-l lg:border-t-0">
                <div class="flex flex-wrap items-center justify-between gap-3 px-5 py-4 sm:px-6">
                    <div>
                        <h3 class="font-semibold text-[var(--color-heading)]">Location map</h3>
                        <p class="mt-1 text-xs text-[var(--color-muted)]">{{ $location->name }}</p>
                    </div>
                    @if ($hasMapLink)
                        <a href="{{ $mapLink }}" target="_blank" rel="noopener noreferrer" aria-label="Open {{ $location->name }} in Maps (opens in a new tab)" class="inline-flex min-h-10 shrink-0 items-center justify-center gap-2 rounded-lg border border-[var(--color-primary)] bg-white px-3 py-2 text-sm font-semibold text-[var(--color-primary)] hover:bg-[var(--color-primary-light)] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[var(--color-primary)]">
                            <svg aria-hidden="true" class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z" />
                                <circle cx="12" cy="10" r="2.5" />
                            </svg>
                            Open in Maps
                        </a>
                    @endif
                </div>
                <iframe
                    src="{{ $mapEmbedUrl }}"
                    title="Map showing {{ $location->name }} at {{ $location->address }}"
                    class="min-h-[300px] w-full flex-1 border-0 lg:min-h-0"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    allowfullscreen
                ></iframe>
            </div>
        </article>
    @empty
        <div class="rounded-2xl border border-[var(--color-border)] bg-[var(--color-card)] p-6 sm:p-10 text-center">
            <h2 class="text-xl font-semibold text-[var(--color-heading)]">No active locker yet</h2>
            <p class="mt-3 text-sm text-[var(--color-body)]">Choose an available locker at a location, then confirm to start using it.</p>
            <a href="{{ route('user.locations.index') }}" class="mt-6 inline-flex rounded-xl bg-[var(--color-btn-primary)] px-5 py-3 text-sm font-semibold text-[var(--color-btn-text)] hover:bg-[var(--color-btn-primary-hover)]">Find a locker</a>
        </div>
    @endforelse
    </div>
</section>
@endsection
