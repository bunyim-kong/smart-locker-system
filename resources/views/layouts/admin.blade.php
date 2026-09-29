<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Smart Locker')</title>

    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>
<body class="bg-[var(--color-bg)] font-[Inter,sans-serif] text-[var(--color-body)] antialiased">
    <section class="flex">
        @include('admin.partial.sidebar')

        <div class="min-w-0 flex-1 flex flex-col min-h-screen pt-20 sm:ml-64">
            @include('admin.partial.header')

            <main class="min-w-0 flex-1 px-[18px] py-6 sm:px-6">
                @yield('content')
            </main>
        </div>
    </section>
    <script>
        const sidebar = document.getElementById('admin-sidebar');
        const toggle = document.getElementById('sidebar-toggle');
        const closeButton = document.getElementById('sidebar-close');
        const backdrop = document.getElementById('sidebar-backdrop');
        const desktop = window.matchMedia('(min-width: 640px)');
        let sidebarOpen = false;

        function setSidebarOpen(open, restoreFocus = false) {
            sidebarOpen = open && !desktop.matches;
            sidebar.classList.toggle('-translate-x-full', !sidebarOpen);
            sidebar.inert = !desktop.matches && !sidebarOpen;
            backdrop.classList.toggle('hidden', !sidebarOpen);
            toggle.setAttribute('aria-expanded', String(sidebarOpen));
            document.body.classList.toggle('overflow-hidden', sidebarOpen);
            if (sidebarOpen) closeButton.focus();
            if (restoreFocus) toggle.focus();
        }

        toggle.addEventListener('click', () => setSidebarOpen(!sidebarOpen));
        closeButton.addEventListener('click', () => setSidebarOpen(false, true));
        backdrop.addEventListener('click', () => setSidebarOpen(false, true));
        desktop.addEventListener('change', () => setSidebarOpen(false));
        document.addEventListener('keydown', (event) => {
            if (!sidebarOpen) return;
            if (event.key === 'Escape') setSidebarOpen(false, true);
            if (event.key === 'Tab') {
                const items = sidebar.querySelectorAll('a[href], button:not([disabled])');
                const first = items[0];
                const last = items[items.length - 1];
                if (event.shiftKey && document.activeElement === first) {
                    event.preventDefault();
                    last.focus();
                } else if (!event.shiftKey && document.activeElement === last) {
                    event.preventDefault();
                    first.focus();
                }
            }
        });
        setSidebarOpen(false);
    </script>
</body>
</html>
