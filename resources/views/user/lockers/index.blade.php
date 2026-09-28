@extends('layouts.app')

@section('title', 'My Lockers - Smart Locker')

@section('content')
<section class="mx-auto max-w-4xl px-4 pb-10 pt-6 sm:px-6 sm:pb-16 lg:pt-14">
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
        <article class="min-w-0 overflow-hidden rounded-2xl border border-[var(--color-border)] bg-[var(--color-card)]">
            <div class="flex flex-wrap items-center justify-between gap-3 border-b border-[var(--color-border)] p-6">
                <div>
                    <h2 class="text-xl font-bold text-[var(--color-heading)]">Locker {{ $activeUsage->locker->name }}</h2>
                    <p class="mt-1 text-sm text-[var(--color-body)]">{{ $activeUsage->locker->location->name }} &middot; {{ $activeUsage->locker->location->address }}</p>
                    @php
                        $mapLink = $activeUsage->locker->location->map_link;
                        $hasMapLink = filter_var($mapLink, FILTER_VALIDATE_URL)
                            && in_array(strtolower(parse_url($mapLink, PHP_URL_SCHEME) ?? ''), ['http', 'https'], true);
                    @endphp
                    @if ($hasMapLink)
                        <a href="{{ $mapLink }}" target="_blank" rel="noopener noreferrer" aria-label="Open location in Maps for locker {{ $activeUsage->locker->name }} (opens in a new tab)" class="mt-3 inline-flex min-h-11 items-center justify-center gap-2 rounded-lg border border-[var(--color-primary)] px-4 py-2 text-sm font-semibold text-[var(--color-primary)] hover:bg-[var(--color-primary-light)] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[var(--color-primary)]">
                            <svg aria-hidden="true" class="size-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z" />
                                <circle cx="12" cy="10" r="2.5" />
                            </svg>
                            Open location in Maps
                        </a>
                    @else
                        <p class="mt-3 text-sm text-[var(--color-body)]">Map directions are not available. Use the address above to find this locker.</p>
                    @endif
                </div>
                <span class="rounded-full bg-[var(--color-primary-soft)] px-3 py-1 text-xs font-semibold text-[var(--color-primary)]">Assigned to you</span>
            </div>
            <div class="flex flex-col items-center gap-4 p-6 text-center sm:p-8">
                <p class="text-sm font-medium text-[var(--color-heading)]">Your access code</p>
                @if ($activeUsage->access_code)
                    <p class="rounded-xl bg-[var(--color-primary-light)] max-w-full whitespace-nowrap px-3 py-4 font-mono text-3xl font-bold tracking-[0.12em] sm:px-6 sm:text-4xl sm:tracking-[0.2em] text-[var(--color-heading)]">{{ $activeUsage->access_code }}</p>
                    <p class="max-w-sm text-sm text-[var(--color-body)]">Keep this code private. You can return to this page while your locker is in use.</p>
                @else
                    <p class="text-sm text-[var(--color-body)]">No code is available for this existing session. Contact an administrator for assistance.</p>
                @endif
                <p class="text-xs text-[var(--color-body)]">Started {{ $activeUsage->start_time->format('M j, Y · g:i A') }}</p>
            </div>
            <div class="border-t border-[var(--color-border)] p-6">
                <form action="{{ route('user.lockers.finish', $activeUsage) }}" method="POST" class="flex flex-col gap-4">
                    @csrf
                    <label class="flex items-start gap-3 text-sm text-[var(--color-body)]">
                        <input type="checkbox" required class="mt-1 accent-[var(--color-primary)]">
                        <span>I have collected my belongings and am ready to release this locker.</span>
                    </label>
                    <button type="submit" class="rounded-xl bg-[var(--color-btn-primary)] px-5 py-3 text-sm font-semibold text-[var(--color-btn-text)] hover:bg-[var(--color-btn-primary-hover)] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[var(--color-primary)]">Finish use</button>
                </form>
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

    <h2 class="mb-4 mt-10 text-xl font-bold text-[var(--color-heading)]">Past usage</h2>
    <div tabindex="0" role="region" aria-label="Past locker usage" class="overflow-x-auto rounded-xl border border-[var(--color-border)] bg-[var(--color-card)]">
        <table class="w-full min-w-[640px] text-left text-sm">
            <thead class="whitespace-nowrap bg-[var(--color-primary-light)] text-[var(--color-heading)]"><tr><th class="p-4">Locker</th><th class="p-4">Location</th><th class="p-4">Started</th><th class="p-4">Finished</th></tr></thead>
            <tbody>
                @forelse ($pastUsage as $usage)
                    <tr class="border-t border-[var(--color-border)] text-[var(--color-body)]">
                        <td class="p-4">{{ $usage->locker->name }}</td><td class="p-4">{{ $usage->locker->location->name }}</td>
                        <td class="whitespace-nowrap p-4">{{ $usage->start_time->format('M j, Y g:i A') }}</td><td class="whitespace-nowrap p-4">{{ $usage->end_time->format('M j, Y g:i A') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="p-6 text-center text-[var(--color-body)]">Your completed sessions will appear here.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $pastUsage->links() }}</div>
</section>
@endsection
