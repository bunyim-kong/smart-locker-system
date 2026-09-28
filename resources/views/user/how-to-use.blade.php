@extends('layouts.app')

@section('title', 'How to use - Smart Locker')

@section('content')
<section class="bg-[var(--color-primary-dark)] px-4 py-14 text-white sm:px-6 sm:py-20">
    <div class="mx-auto max-w-7xl">
        <p class="text-sm font-semibold uppercase tracking-widest text-[var(--color-footer-text)]">Your quick guide</p>
        <h1 class="mt-4 text-4xl font-bold sm:text-5xl">How to use Smart Locker</h1>
        <p class="mt-5 max-w-2xl leading-7 text-[var(--color-footer-text)]">From finding a locker to collecting your belongings, manage your storage in a few simple steps.</p>
    </div>
</section>

<section aria-label="Getting started" class="mx-auto max-w-7xl px-4 py-10 sm:px-6 sm:py-16">
    <ol class="grid list-none gap-6 p-0 md:grid-cols-2">
        @foreach ([
            ['title' => 'Create an account or log in', 'description' => 'Register with your details, or log in to your existing account. You need to be signed in to choose and use a locker.'],
            ['title' => 'Find a location and locker', 'description' => 'Open Locations, choose a location, and check its lockers. Select a locker marked Available to view its details.'],
            ['title' => 'Confirm your locker', 'description' => 'Select Confirm use to assign the locker to your account. Your session starts immediately and a six-digit access code is generated.'],
            ['title' => 'Keep your code handy', 'description' => 'Open My Lockers to see your access code, locker details, and location. Keep the code private; you can return to this page during your session.'],
            ['title' => 'Collect your belongings', 'description' => 'Return to your locker and collect all your belongings before ending your session. Check that nothing has been left behind.'],
            ['title' => 'Finish your session', 'description' => 'In My Lockers, confirm that you have collected your belongings, then select Finish use. The locker is released and your completed session appears in your usage history.'],
        ] as $step)
            <li class="flex items-start gap-4 rounded-2xl border border-[var(--color-border)] bg-[var(--color-card)] p-6 sm:p-8">
                <span class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-[var(--color-primary-light)] text-lg font-bold text-[var(--color-primary)]">{{ $loop->iteration }}</span>
                <div>
                    <h2 class="text-xl font-bold text-[var(--color-heading)]">{{ $step['title'] }}</h2>
                    <p class="mt-3 text-sm leading-7 text-[var(--color-body)]">{{ $step['description'] }}</p>
                </div>
            </li>
        @endforeach
    </ol>

    <aside class="mt-8 rounded-2xl bg-[var(--color-primary-light)] p-6 sm:p-8">
        <h2 class="text-xl font-bold text-[var(--color-heading)]">Before you start</h2>
        <p class="mt-3 max-w-3xl text-sm leading-7 text-[var(--color-body)]">Lockers marked In Use or Maintenance are unavailable. If your access code is missing or you need help with a locker, contact an administrator for assistance.</p>
    </aside>

    <div class="mt-8 flex flex-wrap items-center gap-4">
        <a href="{{ route('user.locations.index') }}" class="inline-flex min-h-11 items-center justify-center rounded-xl bg-[var(--color-btn-primary)] px-6 py-3 text-sm font-semibold text-[var(--color-btn-text)] hover:bg-[var(--color-btn-primary-hover)]">Find a locker</a>
        <a href="{{ route('about') }}" class="inline-flex min-h-11 items-center text-sm font-semibold text-[var(--color-primary)] hover:underline">About Smart Locker &rarr;</a>
    </div>
</section>
@endsection
