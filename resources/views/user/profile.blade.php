@extends('layouts.app')

@section('title', 'My Profile - Smart Locker')

@section('content')
<section class="mx-auto w-full max-w-7xl px-[18px] pb-10 pt-8 sm:px-6 sm:pb-16 lg:pt-6">
    <div class="mb-8">
        <p class="text-xs font-bold uppercase tracking-[0.16em] text-[var(--color-primary)]">Account</p>
        <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-[var(--color-heading)] sm:text-4xl">My Profile</h1>
        <p class="mt-2 max-w-2xl text-sm leading-6 text-[var(--color-body)]">Manage your account and review your completed locker sessions.</p>
    </div>

    <div class="grid items-start gap-6 lg:grid-cols-[minmax(17rem,0.8fr)_minmax(0,1.8fr)]">
        <aside class="flex flex-col gap-5">
            <article class="overflow-hidden rounded-2xl border border-[var(--color-border)] bg-[var(--color-card)] shadow-[0_8px_25px_rgba(15,23,42,0.05)]">
                <div class="flex flex-col justify-between gap-6 bg-[var(--color-primary-dark)] p-6 text-white sm:flex-row sm:items-start sm:p-7">
                    <div>
                        <span class="flex size-16 items-center justify-center rounded-2xl border border-white/20 bg-white/10 text-xl font-bold tracking-wide">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', auth()->user()->name)[1] ?? '', 0, 1)) }}
                        </span>
                        <h2 class="mt-5 text-xl font-bold">{{ auth()->user()->name }}</h2>
                        <p class="mt-1 break-all text-sm text-[var(--color-footer-text)]">{{ auth()->user()->email }}</p>
                        <span class="mt-4 inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1.5 text-xs font-semibold text-white">
                            <span class="size-1.5 rounded-full bg-emerald-400"></span>
                            {{ auth()->user()->isAdmin() ? 'Administrator' : 'User' }}
                        </span>
                    </div>

                    <form action="{{ route('user.logout') }}" method="POST" class="shrink-0 sm:ml-auto">
                        @csrf
                        <button type="submit" class="inline-flex min-h-10 items-center justify-center gap-2 rounded-lg border border-white/20 bg-white/5 px-3 py-2 text-sm font-semibold text-white transition-colors hover:bg-white/10 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                            <svg aria-hidden="true" class="size-4 stroke-current stroke-2" viewBox="0 0 24 24" fill="none">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"></path>
                            </svg>
                            Log out
                        </button>
                    </form>
                </div>

                <dl class="grid gap-4 p-6 sm:p-7">
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wide text-[var(--color-muted)]">Full name</dt>
                        <dd class="mt-1 text-sm font-semibold text-[var(--color-heading)]">{{ auth()->user()->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wide text-[var(--color-muted)]">Email address</dt>
                        <dd class="mt-1 break-all text-sm font-semibold text-[var(--color-heading)]">{{ auth()->user()->email }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wide text-[var(--color-muted)]">Member since</dt>
                        <dd class="mt-1 text-sm font-semibold text-[var(--color-heading)]">{{ auth()->user()->created_at->format('M d, Y') }}</dd>
                    </div>
                </dl>
            </article>
        </aside>

        <section aria-labelledby="past-usage-heading" class="min-w-0 overflow-hidden rounded-2xl border border-[var(--color-border)] bg-[var(--color-card)] shadow-[0_8px_25px_rgba(15,23,42,0.05)]">
            <div class="flex flex-wrap items-end justify-between gap-3 border-b border-[var(--color-border)] px-5 py-5 sm:px-7">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.14em] text-[var(--color-primary)]">Your activity</p>
                    <h2 id="past-usage-heading" class="mt-1 text-xl font-bold text-[var(--color-heading)]">Past usage</h2>
                    <p class="mt-1 text-sm text-[var(--color-muted)]">A record of your completed locker sessions.</p>
                </div>
                <span class="rounded-full bg-[var(--color-primary-light)] px-3 py-1.5 text-xs font-semibold text-[var(--color-primary)]">{{ $pastUsage->total() }} sessions</span>
            </div>

            @if ($pastUsage->count())
                <div tabindex="0" role="region" aria-label="Past locker usage history" class="overflow-x-auto">
                    <table class="w-full min-w-[680px] text-left text-sm">
                        <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wide text-[var(--color-muted)]">
                            <tr>
                                <th scope="col" class="px-5 py-3.5 sm:px-7">Locker</th>
                                <th scope="col" class="px-5 py-3.5">Location</th>
                                <th scope="col" class="px-5 py-3.5">Started</th>
                                <th scope="col" class="px-5 py-3.5 sm:pr-7">Finished</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pastUsage as $usage)
                                <tr class="border-t border-[var(--color-border)] text-[var(--color-body)]">
                                    <td class="whitespace-nowrap px-5 py-4 font-semibold text-[var(--color-heading)] sm:pl-7">{{ $usage->locker->name }}</td>
                                    <td class="px-5 py-4">{{ $usage->locker->location->name }}</td>
                                    <td class="whitespace-nowrap px-5 py-4">{{ $usage->start_time->format('M j, Y · g:i A') }}</td>
                                    <td class="whitespace-nowrap px-5 py-4 sm:pr-7">{{ $usage->end_time->format('M j, Y · g:i A') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="border-t border-[var(--color-border)] px-5 py-4 sm:px-7">{{ $pastUsage->links() }}</div>
            @else
                <div class="flex min-h-64 flex-col items-center justify-center px-6 py-12 text-center">
                    <span class="flex size-12 items-center justify-center rounded-2xl bg-[var(--color-primary-light)] text-[var(--color-primary)]">
                        <svg aria-hidden="true" class="size-6 stroke-current stroke-[1.8]" viewBox="0 0 24 24" fill="none">
                            <rect x="4" y="3" width="16" height="18" rx="2"></rect>
                            <path d="M12 3v18M8 8h1M15 8h1M8 13h1M15 13h1"></path>
                        </svg>
                    </span>
                    <h3 class="mt-4 text-base font-semibold text-[var(--color-heading)]">No past sessions yet</h3>
                    <p class="mt-2 max-w-sm text-sm leading-6 text-[var(--color-body)]">Once you finish using a locker, that session will appear here.</p>
                    <a href="{{ route('user.locations.index') }}" class="mt-5 inline-flex min-h-11 items-center justify-center rounded-xl bg-[var(--color-btn-primary)] px-5 py-2.5 text-sm font-semibold text-[var(--color-btn-text)] no-underline transition-colors hover:bg-[var(--color-btn-primary-hover)] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[var(--color-primary)]">Browse locations</a>
                </div>
            @endif
        </section>
    </div>
</section>
@endsection
