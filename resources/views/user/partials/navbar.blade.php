    <header class="sticky top-0 z-40 m-0 flex w-full flex-col items-center justify-center border-b-2 border-[var(--color-border)] bg-white/100 p-0">
        <div class="m-0 flex w-full max-w-7xl items-center justify-between gap-3 px-4 py-3 sm:px-6">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5 no-underline">
                <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 36 36" fill="none" aria-hidden="true">
                    <rect width="36" height="36" rx="9" fill="var(--color-primary-soft)"/>
                    <rect x="8" y="11" width="20" height="17" rx="3" fill="var(--color-heading)"/>
                    <path d="M18 11V28" stroke="#fff" stroke-width="1.4"/>
                    <circle cx="14.2" cy="19.5" r="1.15" fill="#fff"/>
                    <circle cx="21.8" cy="19.5" r="1.15" fill="#fff"/>
                    <path d="M13 9.2c2.7-2.4 7.3-2.4 10 0" stroke="var(--color-primary)" stroke-width="1.8" stroke-linecap="round"/>
                    <path d="M15.2 11c1.6-1.4 3.9-1.4 5.6 0" stroke="var(--color-primary)" stroke-width="1.8" stroke-linecap="round"/>
                    <circle cx="18" cy="13.1" r="1.15" fill="var(--color-primary)"/>
                </svg>

                <div class="flex flex-col border-l border-[var(--color-border)] pl-2">
                    <span class="font-sans text-[1.3rem] font-extrabold tracking-[0.18em] leading-[1.1] text-[var(--color-heading)]">SMART</span>
                    <span class="font-sans text-[0.78rem] font-medium tracking-[0.18em] text-[var(--color-primary)]">LOCKER</span>
                </div>
            </a>

            <nav class="hidden lg:flex">
                <ul class="m-0 flex list-none gap-6 p-0 py-3">
                    <li class="m-0 p-0 list-none">
                        <a class="text-base no-underline transition-all duration-200 hover:font-bold hover:text-[var(--color-heading)] {{ request()->routeIs('home') ? 'text-[var(--color-heading)] font-bold' : 'text-[var(--color-body)]' }} " href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="m-0 p-0 list-none">
                        <a class="text-base no-underline transition-all duration-200 hover:font-bold hover:text-[var(--color-heading)] {{ request()->routeIs('user.locations.*') ? 'text-[var(--color-heading)] font-bold' : 'text-[var(--color-body)]' }} " href="{{ route('user.locations.index') }}">Location</a>
                    </li>
                    @auth
                    <li><a href="{{ route('user.lockers.index') }}" class="text-base font-semibold text-[var(--color-primary)]">My Lockers</a></li>
                    @endauth
                    <li class="m-0 p-0 list-none">
                        <a class="text-base no-underline transition-all duration-200 hover:font-bold hover:text-[var(--color-heading)] {{ request()->routeIs('how-to-use') ? 'text-[var(--color-heading)] font-bold' : 'text-[var(--color-body)]' }} " href="{{ route('how-to-use') }}">How to use</a>
                    </li>
                    <li class="m-0 p-0 list-none">
                        <a class="text-base no-underline transition-all duration-200 hover:font-bold hover:text-[var(--color-heading)] {{ request()->routeIs('about') ? 'text-[var(--color-heading)] font-bold' : 'text-[var(--color-body)]' }} " href="{{ route('about') }}">About</a>
                    </li>
                </ul>
            </nav>

            <div class="flex items-center justify-center gap-2.5">
                @auth
                <a href="{{ route('user.profile') }}" class="inline-flex min-h-11 min-w-0 items-center gap-2 no-underline hover:opacity-80">
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[var(--color-heading)] text-xs font-semibold text-white">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', auth()->user()->name)[1] ?? '', 0, 1)) }}
                    </span>
                    <span class="hidden min-w-0 max-w-40 flex-col leading-tight xl:flex">
                        <span class="truncate text-sm font-semibold text-[var(--color-heading)]">{{ auth()->user()->name }}</span>
                        <span class="text-[11px] text-[var(--color-muted)]">{{ auth()->user()->isAdmin() ? 'Admin' : 'User' }}</span>
                    </span>
                </a>
                @endauth

                @guest
                <div class="hidden items-center justify-center gap-5 sm:flex">
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-[var(--color-primary)] no-underline hover:opacity-80">
                    Log in
                </a>
                <a href="{{ route('register') }}" class="text-sm font-semibold rounded-md bg-[var(--color-primary)] py-2 px-6 text-[var(--color-btn-text)] transition duration-200 hover:bg-[var(--color-primary-hover)] no-underline hover:opacity-80">
                    Register
                </a>
                </div>
                @endguest

                <button id="mobile-menu-toggle" class="flex size-11 shrink-0 items-center justify-center cursor-pointer border-0 bg-transparent text-[var(--color-heading)] lg:hidden" aria-label="Open menu" aria-controls="mobile-navlink" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-[30px] w-[30px]">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
        </div>

        <div id="mobile-navlink" class="hidden max-h-[calc(100dvh-80px)] w-full overflow-y-auto lg:hidden">
            <ul class="m-0 flex list-none flex-col gap-1 px-4 py-3 [&_a]:flex [&_a]:min-h-11 [&_a]:items-center">
                @auth
                <li><a href="{{ route('user.lockers.index') }}" class="font-semibold text-[var(--color-primary)]">My Lockers</a></li>
                @endauth
                <li class="list-none">
                    <a href="{{ route('home') }}" class="no-underline text-[var(--color-heading)] font-bold transition-all duration-200 hover:font-bold hover:text-[var(--color-heading)]">Home</a>
                </li>
                <li class="list-none">
                    <a href="{{ route('user.locations.index') }}" class="no-underline text-[var(--color-body)] transition-all duration-200 hover:font-bold hover:text-[var(--color-heading)]">Location</a>
                </li>
                <li class="list-none">
                    <a href="{{ route('how-to-use') }}" class="no-underline text-[var(--color-body)] transition-all duration-200 hover:font-bold hover:text-[var(--color-heading)]">How to use</a>
                </li>
                <li class="list-none">
                    <a href="{{ route('about') }}" class="no-underline text-[var(--color-body)] transition-all duration-200 hover:font-bold hover:text-[var(--color-heading)]">About</a>
                </li>
                @guest
                <li class="sm:hidden"><a href="{{ route('login') }}" class="font-semibold text-[var(--color-primary)]">Log in</a></li>
                <li class="sm:hidden"><a href="{{ route('register') }}" class="font-semibold text-[var(--color-primary)]">Register</a></li>
                @endguest
            </ul>
        </div>
    </header>

    <script>
        document.getElementById('mobile-menu-toggle').addEventListener('click', function() {
            const menu = document.getElementById('mobile-navlink');
            menu.classList.toggle('hidden');
            const expanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', String(!expanded));
            this.setAttribute('aria-label', expanded ? 'Open menu' : 'Close menu');
        });
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                document.getElementById('mobile-navlink').classList.add('hidden');
                const toggle = document.getElementById('mobile-menu-toggle');
                if (toggle.getAttribute('aria-expanded') === 'true') {
                    toggle.setAttribute('aria-expanded', 'false');
                    toggle.setAttribute('aria-label', 'Open menu');
                    toggle.focus();
                }
            }
        });
    </script>
