@extends('layouts.app')

@section('title', 'About - Smart Locker')

@section('content')
<section class="bg-[var(--color-primary-dark)] px-4 py-14 text-white sm:px-6 sm:py-20">
    <div class="mx-auto max-w-7xl">
        <p class="text-sm font-semibold uppercase tracking-widest text-[var(--color-footer-text)]">About Smart Locker</p>
        <h1 class="mt-4 max-w-3xl text-4xl font-bold sm:text-5xl">A simpler way to manage your locker.</h1>
        <p class="mt-5 max-w-2xl leading-7 text-[var(--color-footer-text)]">Find a location, choose an available locker, and keep track of your session in one place.</p>
    </div>
</section>

<section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 sm:py-16">
    <div class="grid items-start gap-8 lg:grid-cols-2 lg:gap-16">
        <div>
            <h2 class="text-2xl font-bold text-[var(--color-heading)] sm:text-3xl">Storage made straightforward</h2>
            <p class="mt-5 leading-8 text-[var(--color-body)]">Smart Locker brings locker availability, location details, and your usage information together. It helps you see which lockers are available and manage the one you are using from your account.</p>
            <p class="mt-4 leading-8 text-[var(--color-body)]">Whether you are starting a new session or returning to collect your belongings, My Lockers keeps your locker details and access code within reach.</p>
        </div>
        <div class="rounded-2xl border border-[var(--color-border)] bg-[var(--color-card)] p-6 sm:p-8">
            <h2 class="text-xl font-bold text-[var(--color-heading)]">From start to finish</h2>
            <p class="mt-4 text-sm leading-7 text-[var(--color-body)]">Choose an available locker at your preferred location. Confirm use to start your session, then return to My Lockers whenever you need your code. Once you have collected your belongings, finish the session to release the locker.</p>
            <a href="{{ route('how-to-use') }}" class="mt-5 inline-flex min-h-11 items-center text-sm font-semibold text-[var(--color-primary)] hover:underline">Read the step-by-step guide &rarr;</a>
        </div>
    </div>

    <div class="mt-12 grid gap-6 md:grid-cols-3">
        @foreach ([
            ['title' => 'Find your location', 'description' => 'Browse locations and view their addresses and locker availability before choosing where to store your belongings.'],
            ['title' => 'Manage your session', 'description' => 'See your assigned locker and access code in My Lockers, then release the locker when you are finished.'],
            ['title' => 'See your usage history', 'description' => 'Review completed sessions, including the locker, location, and when your usage started and finished.'],
        ] as $feature)
            <article class="rounded-2xl border border-[var(--color-border)] bg-[var(--color-card)] p-6 sm:p-8">
                <span aria-hidden="true" class="mb-5 block h-1 w-10 rounded-full bg-[var(--color-primary)]"></span>
                <h2 class="text-xl font-bold text-[var(--color-heading)]">{{ $feature['title'] }}</h2>
                <p class="mt-3 text-sm leading-7 text-[var(--color-body)]">{{ $feature['description'] }}</p>
            </article>
        @endforeach
    </div>

    <div class="mt-12 flex flex-col items-start justify-between gap-6 rounded-2xl bg-[var(--color-primary-light)] p-6 sm:flex-row sm:items-center sm:p-8">
        <div>
            <h2 class="text-2xl font-bold text-[var(--color-heading)]">Ready to get started?</h2>
            <p class="mt-2 text-sm leading-6 text-[var(--color-body)]">Explore locations and find an available locker.</p>
        </div>
        <a href="{{ route('user.locations.index') }}" class="inline-flex min-h-11 shrink-0 items-center justify-center rounded-xl bg-[var(--color-btn-primary)] px-6 py-3 text-sm font-semibold text-[var(--color-btn-text)] hover:bg-[var(--color-btn-primary-hover)]">Find a locker</a>
    </div>
</section>
@endsection
