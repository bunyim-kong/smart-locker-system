<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/navbar.css') }}">
</head>
<body>
    <header class="header">
        <div class="navbar">
            <a href="#" class="logo-minimal">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="icon">
                    <path d="M13 2H6.5A2.5 2.5 0 0 0 4 4.5v15"/>
                    <path d="M17 2v6"/><path d="M17 4h2"/>
                    <path d="M20 15.2V21a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"/>
                    <circle cx="17" cy="10" r="2"/>
                </svg>
                <div class="text-group">
                    <span class="primary-text">SMARTLOCKER</span>
                    <span class="subtext">SECURITY SYSTEM</span>
                </div>
            </a>

            <div class="nav-link">
                <ul>
                    <li>
                        <a class="active" href="">Home</a>
                    </li>

                    <li>
                        <a href="">Location</a>
                    </li>

                    <li>
                        <a href="">How to use</a>
                    </li>

                    <li>
                        <a href="">About</a>
                    </li>
                </ul>
            </div>

            <div class="profile flex">
                <a href="" class="profile-btn">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </span>
                </a>

                <button id="mobile-menu-toggle" class="mobile-menu-toggle md:hidden" aria-label="Open menu" aria-controls="mobile-navlink" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
        </div>

        <div id="mobile-navlink" class="mobile-navlink hidden">
            <ul>
                <li>
                    <a href="" class="active">Home</a>
                </li>

                <li>
                    <a href="">Location</a>
                </li>

                <li>
                    <a href="">How to use</a>
                </li>

                <li>
                    <a href="">About</a>
                </li>
            </ul>
        </div>
    </header>

    <script>
        document.getElementById('mobile-menu-toggle').addEventListener('click', function() {
            const menu = document.getElementById('mobile-navlink');
            menu.classList.toggle('hidden');
            const expanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !expanded);
        });
    </script>
</body>
</html>