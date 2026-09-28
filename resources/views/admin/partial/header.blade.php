<header class="fixed inset-x-0 top-0 z-30 flex h-20 items-center justify-between gap-4 border-b border-[var(--color-border)] bg-[var(--color-card)] px-4 sm:left-64 sm:px-6">
    <div class="flex min-w-0 items-center gap-3">
        <button id="sidebar-toggle" type="button" aria-controls="admin-sidebar" aria-expanded="false" aria-label="Open navigation" class="shrink-0 rounded-lg p-2 text-[var(--color-heading)] hover:bg-[var(--color-primary-soft)] focus-visible:outline-2 focus-visible:outline-[var(--color-primary)] sm:hidden">
            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        <h1 class="truncate text-xl font-bold text-[var(--color-heading)] sm:text-2xl">@yield('title', 'Dashboard')</h1>
    </div>
    <a href="" aria-label="View profile for {{ auth()->user()->name }}" class="flex shrink-0 items-center gap-3 rounded-xl p-1.5 transition-colors hover:bg-[var(--color-primary-light)] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[var(--color-primary)]">
        <span aria-hidden="true" class="flex size-10 shrink-0 items-center justify-center rounded-full bg-[var(--color-primary-soft)] text-sm font-bold text-[var(--color-heading)]">{{ \Illuminate\Support\Str::of(auth()->user()->name)->trim()->explode(' ')->filter()->take(2)->map(fn ($part) => \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($part, 0, 1)))->implode('') }}</span>
        <span class="hidden min-w-0 flex-col sm:flex">
            <span class="max-w-48 truncate text-sm font-semibold text-[var(--color-heading)]">{{ auth()->user()->name }}</span>
            <span class="text-xs text-[var(--color-body)]">Administrator</span>
        </span>
    </a>
</header>
