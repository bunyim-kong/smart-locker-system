@extends('layouts.app')

@section('title', 'Locker '.$locker->name.' - Smart Locker')

@section('content')
<section class="mx-auto w-full max-w-7xl px-[18px] pb-10 pt-6 sm:px-6 sm:pb-16 lg:pt-14">
    <a href="{{ route('user.locations.show', $locker->location) }}" class="text-sm font-semibold text-[var(--color-primary)] hover:underline">&larr; Back to {{ $locker->location->name }}</a>
    <article class="mt-6 grid min-w-0 overflow-hidden rounded-2xl border border-[var(--color-border)] bg-[var(--color-card)] lg:grid-cols-2">
        <div class="flex min-h-72 flex-col justify-between bg-[var(--color-primary-dark)] p-6 text-[var(--color-btn-text)] sm:p-8 lg:min-h-[480px] lg:p-10">
            <div>
                <p class="text-xs font-medium uppercase tracking-widest text-[var(--color-footer-text)]">Locker details</p>
                <h1 class="mt-3 text-3xl font-bold sm:text-4xl">Locker {{ $locker->name }}</h1>
                <p class="mt-3 text-sm leading-6 text-[var(--color-footer-text)]">{{ $locker->location->name }} &middot; {{ $locker->location->address }}</p>
            </div>
            <div class="mt-10 rounded-xl border border-white/15 bg-white/5 p-4">
                <p class="text-xs font-medium text-[var(--color-footer-text)]">Current status</p>
                <p class="mt-1 text-lg font-semibold">{{ $occupied ? 'In Use' : $locker->status }}</p>
            </div>
        </div>
        <div class="flex min-w-0 flex-col justify-center gap-6 p-6 sm:p-8 lg:p-10">
            @if ($errors->any())
                <p role="alert" class="rounded-lg border border-[var(--color-danger)] p-4 text-sm text-[var(--color-heading)]">{{ $errors->first() }}</p>
            @endif
            @if ($activeUsage)
                <div class="rounded-2xl border border-[var(--color-success)]/25 bg-[var(--color-primary-light)] p-5 sm:p-6">
                    <div class="flex items-start gap-4">
                        <span class="flex size-11 shrink-0 items-center justify-center rounded-full bg-white text-[var(--color-success)] shadow-sm">
                            <svg aria-hidden="true" class="size-6 stroke-current stroke-[2.5]" viewBox="0 0 24 24" fill="none">
                                <path d="m5 12 4 4L19 6" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-widest text-[var(--color-success)]">Locker assigned</p>
                            <h2 class="mt-1 text-xl font-bold text-[var(--color-heading)]">You’re all set</h2>
                            <p class="mt-2 text-sm leading-6 text-[var(--color-body)]">Your access code, location map, and session controls are ready in My Lockers.</p>
                        </div>
                    </div>
                    <a href="{{ route('user.lockers.index') }}" class="mt-5 inline-flex min-h-12 w-full items-center justify-center gap-2 rounded-xl bg-[var(--color-btn-primary)] px-5 py-3 text-sm font-semibold text-[var(--color-btn-text)] no-underline shadow-sm transition duration-200 hover:bg-[var(--color-btn-primary-hover)] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[var(--color-primary)]">
                        View My Lockers
                        <svg aria-hidden="true" class="size-4 stroke-current stroke-2" viewBox="0 0 24 24" fill="none">
                            <path d="M5 12h14M13 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </div>
            @elseif ($locker->status === 'Available' && !$occupied)
                <div class="rounded-xl bg-[var(--color-primary-light)] p-4 text-sm leading-6 text-[var(--color-body)]">Confirm to assign this locker to your account and generate your six-digit access code. Your usage starts immediately.</div>
                <form action="{{ route('user.lockers.start', $locker) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full rounded-xl bg-[var(--color-btn-primary)] px-5 py-3 text-sm font-semibold text-[var(--color-btn-text)] hover:bg-[var(--color-btn-primary-hover)] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[var(--color-primary)]">Confirm use</button>
                </form>
            @else
                <p class="text-sm text-[var(--color-body)]">This locker is currently unavailable. Please choose another locker.</p>
                <a href="{{ route('user.locations.show', $locker->location) }}" class="font-semibold text-[var(--color-primary)] hover:underline">Find another locker &rarr;</a>
            @endif
        </div>
    </article>
</section>
@endsection
