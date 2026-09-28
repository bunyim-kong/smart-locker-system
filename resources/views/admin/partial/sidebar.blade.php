<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <button id="sidebar-backdrop" type="button" aria-label="Close navigation" tabindex="-1" class="fixed inset-0 z-40 hidden bg-[var(--color-primary-dark)]/40 sm:hidden"></button>
    <aside id="admin-sidebar" aria-label="Admin navigation" class="fixed inset-y-0 left-0 z-50 flex w-64 -translate-x-full flex-col gap-8 border-r border-[var(--color-border)] bg-[var(--color-card)] px-4 py-6 transition-transform motion-reduce:transition-none sm:translate-x-0">
        <div class="flex items-center justify-between gap-2">
            <a href="{{ route('admin.dashboard') }}" aria-label="Smart Locker dashboard" class="inline-flex items-center gap-3 ml-2 rounded-lg no-underline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[var(--color-primary)]">
                <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" class="size-12 shrink-0" viewBox="0 0 36 36" fill="none" aria-hidden="true">
                    <rect width="36" height="36" rx="9" fill="var(--color-primary-soft)" />
                    <rect x="8" y="11" width="20" height="17" rx="3" fill="var(--color-heading)" />
                    <path d="M18 11V28" stroke="#fff" stroke-width="1.4" />
                    <circle cx="14.2" cy="19.5" r="1.15" fill="#fff" />
                    <circle cx="21.8" cy="19.5" r="1.15" fill="#fff" />
                    <path d="M13 9.2c2.7-2.4 7.3-2.4 10 0" stroke="var(--color-primary)" stroke-width="1.8" stroke-linecap="round" />
                    <path d="M15.2 11c1.6-1.4 3.9-1.4 5.6 0" stroke="var(--color-primary)" stroke-width="1.8" stroke-linecap="round" />
                    <circle cx="18" cy="13.1" r="1.15" fill="var(--color-primary)" />
                </svg>

                <div class="flex flex-col border-l border-[var(--color-border)] pl-3">
                    <span class="font-sans text-xl font-extrabold tracking-[0.18em] leading-[1.1] text-[var(--color-heading)]">SMART</span>
                    <span class="font-sans text-sm font-medium tracking-[0.18em] text-[var(--color-primary)]">LOCKER</span>
                </div>
            </a>
            <button id="sidebar-close" type="button" aria-label="Close navigation" class="rounded-md p-1 text-[var(--color-body)] hover:bg-[var(--color-primary-soft)] focus-visible:outline-2 focus-visible:outline-[var(--color-primary)] sm:hidden">&times;</button>
        </div>
        <nav class="min-h-0 flex-1 overflow-y-auto">
            <ul class="flex flex-col gap-2 text-sm font-medium">
                <li>
                    <a href="{{ route('admin.dashboard') }}" aria-current="{{ request()->routeIs('admin.dashboard') ? 'page' : 'false' }}" class="flex items-center rounded-lg px-3 py-2.5 text-[var(--color-body)] transition-colors hover:bg-[var(--color-primary)] hover:text-[var(--color-btn-text)] aria-[current=page]:bg-[var(--color-primary)] aria-[current=page]:text-[var(--color-btn-text)] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[var(--color-primary)]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                        </svg>

                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.locations.index') }}" aria-current="{{ request()->routeIs('admin.locations.*') ? 'page' : 'false' }}" class="flex items-center rounded-lg px-3 py-2.5 text-[var(--color-body)] transition-colors hover:bg-[var(--color-primary)] hover:text-[var(--color-btn-text)] aria-[current=page]:bg-[var(--color-primary)] aria-[current=page]:text-[var(--color-btn-text)] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[var(--color-primary)]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Location</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.lockers.index') }}" aria-current="{{ request()->routeIs('admin.lockers.*') ? 'page' : 'false' }}" class="flex items-center rounded-lg px-3 py-2.5 text-[var(--color-body)] transition-colors hover:bg-[var(--color-primary)] hover:text-[var(--color-btn-text)] aria-[current=page]:bg-[var(--color-primary)] aria-[current=page]:text-[var(--color-btn-text)] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[var(--color-primary)]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Locker</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.usage.index') }}" aria-current="{{ request()->routeIs('admin.usage.*') ? 'page' : 'false' }}" class="flex items-center rounded-lg px-3 py-2.5 text-[var(--color-body)] transition-colors hover:bg-[var(--color-primary)] hover:text-[var(--color-btn-text)] aria-[current=page]:bg-[var(--color-primary)] aria-[current=page]:text-[var(--color-btn-text)] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[var(--color-primary)]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                        </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Usage & Assignment</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center rounded-lg px-3 py-2.5 text-[var(--color-body)] transition-colors hover:bg-[var(--color-primary)] hover:text-[var(--color-btn-text)] aria-[current=page]:bg-[var(--color-primary)] aria-[current=page]:text-[var(--color-btn-text)] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[var(--color-primary)]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.867 19.125h.008v.008h-.008v-.008Z" />
                        </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Maintenance</span>
                    </a>
                </li>

            </ul>
        </nav>
        <form action="{{ route('user.logout') }}" method="POST" class="border-t border-[var(--color-border)] pt-4">
            @csrf
            <button type="submit" class="flex w-full cursor-pointer items-center gap-3 rounded-lg bg-[var(--color-danger)] px-3 py-2.5 text-sm font-semibold text-[var(--color-btn-text)] transition-colors hover:bg-[var(--color-danger)]/90 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[var(--color-danger)]">
                <svg class="size-5 shrink-0" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 5H5v14h4m5-14h5v14h-5M9 12h12m-3-3 3 3-3 3" />
                </svg>
                Log out
            </button>
        </form>
    </aside>
</body>

</html>