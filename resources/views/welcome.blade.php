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
            <a href class="logo">
                <img src="images/logo.webp" alt="Logo">
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