<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/navbar.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <header class="header">
        <div class="navbar">

            <a href="/home" class="logo-link">
                <img
                    src="images/logo.webp"
                    alt="Smart Locker System"
                    class="logo"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
            </a>

            @php
                $current = request()->segment(1); // "home", "location", "how-to-use", "faq"
            @endphp

            <nav class="main-nav">
                <a href="/home" class="nav-link {{ $current === 'home' ? 'active' : '' }}">Home</a>
                <a href="/location" class="nav-link {{ $current === 'location' ? 'active' : '' }}">Location</a>
                <a href="/how-to-use" class="nav-link {{ $current === 'how-to-use' ? 'active' : '' }}">How to Use</a>
                <a href="/faq" class="nav-link {{ $current === 'faq' ? 'active' : '' }}">FAQ</a>
            </nav>

            <div class="flex">
                <a href="/profile" class="profile-link">
                    <span class="profile-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M20 21a8 8 0 0 0-16 0" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                    </span>

                    <span>Profile</span>
                </a>

                <button id="mobile-menu-toggle" class="mobile-menu-toggle md:hidden" aria-label="Open menu" aria-controls="mobile-nav" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>

        </div>

        <div id="mobile-nav" class="mobile-nav hidden">
            <a href="/" class="nav-link active">Home</a>
            <a href="" class="nav-link">Location</a>
            <a href="/how-to-use" class="nav-link">How to Use</a>
            <a href="/faq" class="nav-link">FAQ</a>
        </div>
    </header>

    <script>
        document.getElementById('mobile-menu-toggle').addEventListener('click', function() {
            const menu = document.getElementById('mobile-nav');
            menu.classList.toggle('hidden');
            const expanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !expanded);
        });
    </script>
</body>
</html>