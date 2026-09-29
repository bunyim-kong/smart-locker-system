@extends('layouts.app')

@section('title', 'About - Smart Locker')

@section('content')
    <section class="relative isolate overflow-hidden bg-[var(--color-primary-dark)] text-white">
        <div aria-hidden="true" class="pointer-events-none absolute -right-28 -top-36 h-96 w-96 rounded-full bg-blue-400/15 blur-3xl"></div>
        <div aria-hidden="true" class="pointer-events-none absolute -bottom-44 left-1/4 h-80 w-80 rounded-full bg-cyan-300/10 blur-3xl"></div>

        <div class="relative mx-auto grid max-w-7xl items-center gap-12 px-[18px] py-16 sm:px-6 sm:py-20 lg:grid-cols-[1.1fr_0.9fr] lg:gap-16 lg:py-24">
            <div>
                <span class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/[0.07] px-4 py-2 text-xs font-bold uppercase tracking-[0.14em] text-blue-100">
                    <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                    About Smart Locker
                </span>
                <h1 class="mt-6 max-w-2xl text-4xl font-extrabold leading-[1.08] tracking-[-0.04em] sm:text-5xl lg:text-6xl">A little more room for <span class="text-blue-300">what matters.</span></h1>
                <p class="mt-6 max-w-xl text-base leading-8 text-slate-300 sm:text-lg">Find a convenient location, choose an available locker, and manage your storage session from one simple place.</p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('user.locations.index') }}" class="inline-flex min-h-12 items-center justify-center rounded-xl bg-white px-6 py-3 text-sm font-bold text-[var(--color-primary-dark)] transition hover:-translate-y-0.5 hover:bg-blue-50">Explore locations <span aria-hidden="true" class="ml-2">&rarr;</span></a>
                    <a href="{{ route('how-to-use') }}" class="inline-flex min-h-12 items-center justify-center rounded-xl border border-white/20 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10">How it works</a>
                </div>
            </div>

            <div class="relative mx-auto w-full max-w-md lg:ml-auto">
                <div aria-hidden="true" class="absolute -inset-5 rounded-[2rem] bg-gradient-to-br from-blue-400/20 to-cyan-300/5 blur-xl"></div>
                <div class="relative rounded-[1.75rem] border border-white/15 bg-white/[0.08] p-5 shadow-2xl backdrop-blur sm:p-7">
                    <div class="flex items-center justify-between border-b border-white/10 pb-5">
                        <div class="flex items-center gap-3">
                            <span class="flex size-11 items-center justify-center rounded-xl bg-blue-300/15 text-blue-200">
                                <svg aria-hidden="true" class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="4" y="3" width="16" height="18" rx="2"/><path d="M4 9h16M12 3v18M16.5 13v3"/></svg>
                            </span>
                            <div><p class="text-sm font-bold text-white">Your storage, simplified</p><p class="mt-1 text-xs text-slate-300">A clear view from start to finish</p></div>
                        </div>
                        <span class="rounded-full bg-emerald-400/15 px-3 py-1 text-[11px] font-bold text-emerald-200">Easy access</span>
                    </div>
                    <div class="space-y-3 py-5">
                        @foreach ([['01', 'Choose a location', 'See addresses and availability'], ['02', 'Start your session', 'Keep your locker details close'], ['03', 'Finish when ready', 'Release your locker in a few taps']] as [$number, $title, $description])
                            <div class="flex items-center gap-4 rounded-2xl border border-white/10 bg-slate-950/15 p-4">
                                <span class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-white/10 text-xs font-extrabold text-blue-200">{{ $number }}</span>
                                <div><p class="text-sm font-bold text-white">{{ $title }}</p><p class="mt-1 text-xs text-slate-300">{{ $description }}</p></div>
                                <svg aria-hidden="true" class="ml-auto size-4 shrink-0 text-emerald-300" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="m4 10 4 4 8-8"/></svg>
                            </div>
                        @endforeach
                    </div>
                    <p class="border-t border-white/10 pt-4 text-center text-xs leading-6 text-slate-300">Locker details and usage history stay together in your account.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-[18px] py-14 sm:px-6 sm:py-20">
        <div class="mx-auto max-w-2xl text-center">
            <span class="text-xs font-extrabold uppercase tracking-[0.16em] text-[var(--color-primary)]">Made for everyday convenience</span>
            <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-[var(--color-heading)] sm:text-4xl">Everything you need for a smoother storage experience.</h2>
            <p class="mt-4 text-sm leading-7 text-[var(--color-muted)] sm:text-base">From finding the right spot to wrapping up your visit, the important details are easy to find.</p>
        </div>

        <div class="mt-10 grid gap-5 md:grid-cols-3">
            @foreach ([
                ['icon' => 'M12 21s7-5.2 7-11a7 7 0 1 0-14 0c0 5.8 7 11 7 11Z|M12 10a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z', 'title' => 'Find your location', 'description' => 'Compare locations, addresses, and locker availability before you decide where to store your belongings.', 'tone' => 'bg-blue-50 text-blue-700'],
                ['icon' => 'M4 7h16v13H4z|M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2|M4 12h16', 'title' => 'Manage your session', 'description' => 'Keep your assigned locker and access code close, then release the locker when you are finished.', 'tone' => 'bg-emerald-50 text-emerald-700'],
                ['icon' => 'M4 19V5|M4 19h16|m7 14 3-4 3 2 4-6', 'title' => 'Review your usage', 'description' => 'Look back at completed sessions and see when and where you used a locker.', 'tone' => 'bg-violet-50 text-violet-700'],
            ] as $feature)
                <article class="group rounded-2xl border border-[var(--color-border)] bg-[var(--color-card)] p-6 transition duration-200 hover:-translate-y-1 hover:shadow-[0_16px_35px_rgba(15,23,42,0.08)] sm:p-7">
                    <span class="flex size-12 items-center justify-center rounded-2xl {{ $feature['tone'] }}">
                        <svg aria-hidden="true" class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7">
                            @foreach (explode('|', $feature['icon']) as $path)<path d="{{ $path }}"/>@endforeach
                        </svg>
                    </span>
                    <h3 class="mt-5 text-lg font-bold text-[var(--color-heading)]">{{ $feature['title'] }}</h3>
                    <p class="mt-2 text-sm leading-7 text-[var(--color-body)]">{{ $feature['description'] }}</p>
                </article>
            @endforeach
        </div>

        <div class="mt-10 flex flex-col items-start justify-between gap-5 rounded-3xl bg-[var(--color-primary-light)] p-6 sm:flex-row sm:items-center sm:p-9">
            <div><p class="text-xs font-extrabold uppercase tracking-[0.14em] text-[var(--color-primary)]">Ready when you are</p><h2 class="mt-2 text-2xl font-extrabold text-[var(--color-heading)]">Find a locker that fits your day.</h2><p class="mt-2 text-sm leading-6 text-[var(--color-body)]">Browse locations and check availability before you go.</p></div>
            <a href="{{ route('user.locations.index') }}" class="inline-flex min-h-12 shrink-0 items-center justify-center rounded-xl bg-[var(--color-btn-primary)] px-6 py-3 text-sm font-bold text-[var(--color-btn-text)] transition hover:bg-[var(--color-btn-primary-hover)]">Find a locker <span aria-hidden="true" class="ml-2">&rarr;</span></a>
        </div>
    </section>
@endsection
