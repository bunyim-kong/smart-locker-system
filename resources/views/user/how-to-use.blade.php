@extends('layouts.app')

@section('title', 'How to use - Smart Locker')

@section('content')
    <section class="relative isolate overflow-hidden bg-[var(--color-primary-dark)] text-white">
        <div aria-hidden="true" class="pointer-events-none absolute -right-24 -top-32 size-96 rounded-full bg-blue-400/15 blur-3xl"></div>
        <div class="relative mx-auto grid max-w-7xl items-center gap-10 px-[18px] py-14 sm:px-6 sm:py-20 lg:grid-cols-[1fr_auto] lg:py-24">
            <div>
                <span class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/[0.07] px-4 py-2 text-xs font-bold uppercase tracking-[0.14em] text-blue-100">
                    <svg aria-hidden="true" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="M12 11v5m0-8h.01"/></svg>
                    Your quick guide
                </span>
                <h1 class="mt-6 max-w-3xl text-4xl font-extrabold leading-[1.08] tracking-[-0.04em] sm:text-5xl lg:text-6xl">Your locker, from start to <span class="text-blue-300">finish.</span></h1>
                <p class="mt-5 max-w-2xl text-base leading-8 text-slate-300 sm:text-lg">Follow these simple steps to choose a locker, access it, and wrap up your session.</p>
            </div>
            <div class="flex items-center gap-4 rounded-2xl border border-white/15 bg-white/[0.07] p-5 sm:p-6">
                <span class="flex size-14 shrink-0 items-center justify-center rounded-2xl bg-blue-300/15 text-blue-200">
                    <svg aria-hidden="true" class="size-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="5" y="3" width="14" height="18" rx="2"/><path d="M5 9h14M12 3v18M16 14v2"/></svg>
                </span>
                <div><p class="text-2xl font-extrabold text-white">6 easy steps</p><p class="mt-1 text-sm text-slate-300">Everything from sign-in to checkout</p></div>
            </div>
        </div>
    </section>

    <section aria-label="Getting started" class="mx-auto max-w-7xl px-[18px] py-12 sm:px-6 sm:py-16">
        <div class="mb-8 flex flex-col gap-2 sm:mb-10">
            <span class="text-xs font-extrabold uppercase tracking-[0.16em] text-[var(--color-primary)]">The process</span>
            <h2 class="text-2xl font-extrabold tracking-tight text-[var(--color-heading)] sm:text-3xl">A straightforward visit, step by step</h2>
        </div>

        <ol class="grid list-none gap-4 p-0 md:grid-cols-2 xl:grid-cols-3">
            @foreach ([
                ['title' => 'Sign in to your account', 'description' => 'Register with your details or log in to your existing account. You need to be signed in to start a locker session.', 'icon' => 'M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4|M10 17l5-5-5-5|M15 12H3'],
                ['title' => 'Choose a location', 'description' => 'Browse locations and open one to see its address and locker availability.', 'icon' => 'M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0|M12 10a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5'],
                ['title' => 'Select an available locker', 'description' => 'Choose a locker marked Available to review its details before starting.', 'icon' => 'M4 3h16v18H4z|M4 9h16|M12 3v18|M16 13v3'],
                ['title' => 'Confirm your locker', 'description' => 'Select Confirm use to assign the locker to your account. Your session starts and an access code is generated.', 'icon' => 'M5 12l4 4L19 6'],
                ['title' => 'Keep your access code handy', 'description' => 'Open My Lockers for your code, locker details, and location. Keep your code private.', 'icon' => 'M7 10V7a5 5 0 0 1 10 0v3|M5 10h14v11H5z|M12 14v3'],
                ['title' => 'Collect and finish your session', 'description' => 'Collect all your belongings, then select Finish use in My Lockers. The locker is released and your completed session is saved in your usage history.', 'icon' => 'M4 12l5 5L20 6'],
            ] as $step)
                <li class="group relative rounded-2xl border border-[var(--color-border)] bg-[var(--color-card)] p-5 transition duration-200 hover:-translate-y-1 hover:shadow-[0_16px_35px_rgba(15,23,42,0.08)] sm:p-6">
                    <div class="flex items-start justify-between gap-4">
                        <span class="flex size-12 shrink-0 items-center justify-center rounded-2xl bg-[var(--color-primary-light)] text-[var(--color-primary)]">
                            <svg aria-hidden="true" class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7">
                                @foreach (explode('|', $step['icon']) as $path)<path d="{{ $path }}"/>@endforeach
                            </svg>
                        </span>
                        <span class="text-3xl font-extrabold tracking-tight text-slate-200 transition group-hover:text-blue-100">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <h3 class="mt-5 text-lg font-bold text-[var(--color-heading)]">{{ $step['title'] }}</h3>
                    <p class="mt-2 text-sm leading-7 text-[var(--color-body)]">{{ $step['description'] }}</p>
                </li>
            @endforeach
        </ol>

        <aside class="mt-8 flex flex-col gap-4 rounded-2xl border border-amber-200 bg-amber-50 p-5 sm:flex-row sm:items-start sm:p-6">
            <span class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-amber-700">
                <svg aria-hidden="true" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"><path d="M12 3 2.8 19a1.5 1.5 0 0 0 1.3 2.2h15.8a1.5 1.5 0 0 0 1.3-2.2L12 3Z"/><path d="M12 9v4m0 3h.01"/></svg>
            </span>
            <div><h2 class="font-bold text-amber-950">A couple of things to remember</h2><p class="mt-1 text-sm leading-7 text-amber-900/80">Lockers marked In Use or Maintenance are unavailable. Keep your access code private, and check that you have collected all your belongings before finishing your session. If you need help, contact an administrator.</p></div>
        </aside>

        <div class="mt-10 flex flex-col items-start justify-between gap-5 rounded-3xl bg-[var(--color-primary-light)] p-6 sm:flex-row sm:items-center sm:p-8">
            <div><h2 class="text-2xl font-extrabold text-[var(--color-heading)]">Ready to find your locker?</h2><p class="mt-2 text-sm leading-6 text-[var(--color-body)]">Explore locations and see what is available.</p></div>
            <div class="flex flex-wrap items-center gap-4">
                <a href="{{ route('user.locations.index') }}" class="inline-flex min-h-12 items-center justify-center rounded-xl bg-[var(--color-btn-primary)] px-6 py-3 text-sm font-bold text-[var(--color-btn-text)] transition hover:bg-[var(--color-btn-primary-hover)]">Find a locker <span aria-hidden="true" class="ml-2">&rarr;</span></a>
                <a href="{{ route('about') }}" class="text-sm font-semibold text-[var(--color-primary)] hover:underline">About Smart Locker</a>
            </div>
        </div>
    </section>
@endsection
