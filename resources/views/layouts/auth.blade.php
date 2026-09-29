<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Smart Locker</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body class="min-h-screen bg-[var(--color-bg)] font-[Inter,sans-serif] text-[var(--color-body)] antialiased">
    <div class="mx-auto flex min-h-screen max-w-7xl flex-col px-5 sm:px-8 lg:px-12">
        <main class="flex flex-1 items-center justify-center py-6 sm:py-10">
            <div class="w-full max-w-md overflow-hidden rounded-xl border border-[var(--color-border)] bg-[var(--color-card)] shadow-md shadow-[var(--color-primary-dark)]/10">
                <section aria-labelledby="auth-title" class="flex flex-col justify-center gap-6 px-[18px] py-8 sm:px-6 sm:py-10">
                    <div class="logo-login flex flex-col items-center justify-center gap-4">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.12em] text-[var(--color-primary)]">Welcome to</p>

                        <a href="{{ route('home') }}" aria-label="Smart Locker home" class="inline-flex items-center gap-3 no-underline sm:gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" class="size-12 shrink-0 sm:size-14" viewBox="0 0 36 36" fill="none" aria-hidden="true">
                                <rect width="36" height="36" rx="9" fill="var(--color-primary-soft)" />
                                <rect x="8" y="11" width="20" height="17" rx="3" fill="var(--color-heading)" />
                                <path d="M18 11V28" stroke="#fff" stroke-width="1.4" />
                                <circle cx="14.2" cy="19.5" r="1.15" fill="#fff" />
                                <circle cx="21.8" cy="19.5" r="1.15" fill="#fff" />
                                <path d="M13 9.2c2.7-2.4 7.3-2.4 10 0" stroke="var(--color-primary)" stroke-width="1.8" stroke-linecap="round" />
                                <path d="M15.2 11c1.6-1.4 3.9-1.4 5.6 0" stroke="var(--color-primary)" stroke-width="1.8" stroke-linecap="round" />
                                <circle cx="18" cy="13.1" r="1.15" fill="var(--color-primary)" />
                            </svg>

                            <div class="flex flex-col border-l border-[var(--color-border)] pl-3 sm:pl-4">
                                <span class="font-sans text-2xl font-extrabold tracking-[0.18em] leading-[1.1] text-[var(--color-heading)] sm:text-[1.6rem]">SMART</span>
                                <span class="font-sans text-sm font-medium tracking-[0.18em] text-[var(--color-primary)] sm:text-[1rem]">LOCKER</span>
                            </div>
                        </a>
                    </div>

                    <div class="flex flex-col gap-1 border-t border-[var(--color-border)] pt-6">
                        <h1 id="auth-title" class="text-xl font-bold text-[var(--color-heading)]">@yield('heading')</h1>

                        <p class="text-sm leading-6">@yield('description')</p>
                    </div>

                    @if ($errors->any())
                    <div role="alert" class="rounded-xl border border-[var(--color-danger)]/30 bg-[var(--color-danger)]/5 p-4 text-sm text-[var(--color-heading)]">
                        <p class="font-semibold">Please check your details.</p>
                        <ul class="mt-2 list-disc space-y-1 pl-5">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @yield('content')
                </section>
            </div>
        </main>

        <footer class="py-6 text-center text-xs text-[var(--color-body)]">&copy; {{ date('Y') }} Smart Locker. A smarter way to store.</footer>
    </div>
    <script>
        document.querySelectorAll('[data-password-toggle]').forEach((button) => {
            button.addEventListener('click', () => {
                const input = document.getElementById(button.getAttribute('aria-controls'));
                const visible = input.type === 'password';
                input.type = visible ? 'text' : 'password';
                button.setAttribute('aria-label', visible ? 'Hide password' : 'Show password');
                button.setAttribute('aria-pressed', String(visible));
                button.querySelector('[data-eye-slash]').classList.toggle('hidden', !visible);
            });
        });
    </script>
</body>

</html>
