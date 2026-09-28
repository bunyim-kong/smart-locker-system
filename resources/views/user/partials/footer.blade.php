    <footer class="mt-auto bg-[var(--color-footer)] text-[var(--color-footer-text)]">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-6 px-4 py-6 sm:px-6 max-lg:flex-col max-lg:text-center">
            <div class="flex items-center">
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
                        <span class="font-sans text-[1.3rem] font-extrabold tracking-[0.18em] leading-[1.1] text-[var(--color-btn-text)]">SMART</span>
                        <span class="font-sans text-[0.78rem] font-medium tracking-[0.18em] text-[var(--color-primary)]">LOCKER</span>
                    </div>
                </a>
            </div>

            <nav class="flex flex-wrap justify-center gap-x-6 gap-y-2 text-sm [&_a]:inline-flex [&_a]:min-h-11 [&_a]:items-center">
                <a href="{{ route('how-to-use') }}" class="text-[var(--color-footer-text)] no-underline transition-colors duration-200 hover:text-white">How to Use</a>
                <a href="/locations" class="text-[var(--color-footer-text)] no-underline transition-colors duration-200 hover:text-white">Locations</a>
                <a href="/faq" class="text-[var(--color-footer-text)] no-underline transition-colors duration-200 hover:text-white">FAQ</a>
                <a href="{{ route('about') }}" class="text-[var(--color-footer-text)] no-underline transition-colors duration-200 hover:text-white">About</a>
            </nav>

            <p class="m-0 text-xs text-[var(--color-muted)]">
                © 2026 Smart Locker System
            </p>
        </div>
    </footer>
