@extends('layouts.app')

@section('title', 'Locker '.$locker->name.' - Smart Locker')

@section('content')
<section class="mx-auto max-w-2xl px-5 pb-20 pt-32">
    <a href="{{ route('user.locations.show', $locker->location) }}" class="text-sm font-semibold text-[var(--color-primary)] hover:underline">&larr; Back to {{ $locker->location->name }}</a>
    <article class="mt-6 overflow-hidden rounded-2xl border border-[var(--color-border)] bg-[var(--color-card)]">
        <div class="bg-[var(--color-primary-dark)] p-8 text-[var(--color-btn-text)]">
            <p class="text-xs font-medium uppercase tracking-widest">Locker details</p>
            <h1 class="mt-3 text-3xl font-bold">Locker {{ $locker->name }}</h1>
            <p class="mt-2 text-sm text-[var(--color-footer-text)]">{{ $locker->location->name }} &middot; {{ $locker->location->address }}</p>
        </div>
        <div class="flex flex-col gap-6 p-6 sm:p-8">
            <div class="flex justify-between text-sm"><span class="text-[var(--color-body)]">Status</span><strong class="text-[var(--color-heading)]">{{ $occupied ? 'In Use' : $locker->status }}</strong></div>
            @if ($errors->any())
                <p role="alert" class="rounded-lg border border-[var(--color-danger)] p-4 text-sm text-[var(--color-heading)]">{{ $errors->first() }}</p>
            @endif
            @if ($activeUsage)
                <p class="text-sm leading-6 text-[var(--color-body)]">{{ $activeUsage->locker_id === $locker->id ? 'This locker is assigned to you. View your code on My Locker.' : 'You already have an active locker. Finish using it before choosing another.' }}</p>
                <a href="{{ route('user.lockers.index') }}" class="rounded-xl bg-[var(--color-btn-primary)] px-5 py-3 text-center text-sm font-semibold text-[var(--color-btn-text)] hover:bg-[var(--color-btn-primary-hover)]">Go to My Locker</a>
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
