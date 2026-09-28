@extends('layouts.app')

@section('title', 'My Locker - Smart Locker')

@section('content')
<section class="mx-auto max-w-4xl px-5 pb-20 pt-32">
    <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
        <div>
            <p class="text-xs font-semibold uppercase tracking-widest text-[var(--color-primary)]">Your storage</p>
            <h1 class="mt-2 text-3xl font-bold text-[var(--color-heading)]">My Locker</h1>
        </div>
        <a href="{{ route('user.locations.index') }}" class="font-semibold text-[var(--color-primary)] hover:underline">Browse locations &rarr;</a>
    </div>
    @if (session('success'))
        <p role="status" class="mb-6 rounded-xl border border-[var(--color-border)] bg-[var(--color-primary-light)] p-4 text-sm text-[var(--color-heading)]">{{ session('success') }}</p>
    @endif
    @if ($errors->any())
        <div role="alert" class="mb-6 rounded-xl border border-[var(--color-danger)] p-4 text-sm text-[var(--color-heading)]">{{ $errors->first() }}</div>
    @endif

    @if ($activeUsage)
        <article class="overflow-hidden rounded-2xl border border-[var(--color-border)] bg-[var(--color-card)]">
            <div class="flex flex-wrap items-center justify-between gap-3 border-b border-[var(--color-border)] p-6">
                <div>
                    <h2 class="text-xl font-bold text-[var(--color-heading)]">Locker {{ $activeUsage->locker->name }}</h2>
                    <p class="mt-1 text-sm text-[var(--color-body)]">{{ $activeUsage->locker->location->name }} &middot; {{ $activeUsage->locker->location->address }}</p>
                </div>
                <span class="rounded-full bg-[var(--color-primary-soft)] px-3 py-1 text-xs font-semibold text-[var(--color-primary)]">Assigned to you</span>
            </div>
            <div class="flex flex-col items-center gap-4 p-6 text-center sm:p-8">
                <p class="text-sm font-medium text-[var(--color-heading)]">Your access code</p>
                @if ($activeUsage->access_code)
                    <p class="rounded-xl bg-[var(--color-primary-light)] px-6 py-4 font-mono text-4xl font-bold tracking-[0.2em] text-[var(--color-heading)]">{{ $activeUsage->access_code }}</p>
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
    @else
        <div class="rounded-2xl border border-[var(--color-border)] bg-[var(--color-card)] p-10 text-center">
            <h2 class="text-xl font-semibold text-[var(--color-heading)]">No active locker yet</h2>
            <p class="mt-3 text-sm text-[var(--color-body)]">Choose an available locker at a location, then confirm to start using it.</p>
            <a href="{{ route('user.locations.index') }}" class="mt-6 inline-flex rounded-xl bg-[var(--color-btn-primary)] px-5 py-3 text-sm font-semibold text-[var(--color-btn-text)] hover:bg-[var(--color-btn-primary-hover)]">Find a locker</a>
        </div>
    @endif

    <h2 class="mb-4 mt-10 text-xl font-bold text-[var(--color-heading)]">Past usage</h2>
    <div class="overflow-x-auto rounded-xl border border-[var(--color-border)] bg-[var(--color-card)]">
        <table class="w-full text-left text-sm">
            <thead class="bg-[var(--color-primary-light)] text-[var(--color-heading)]"><tr><th class="p-4">Locker</th><th class="p-4">Location</th><th class="p-4">Started</th><th class="p-4">Finished</th></tr></thead>
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
