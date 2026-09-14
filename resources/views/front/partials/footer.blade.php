<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <footer class="site-footer">
        <div class="footer-container">

            <div class="footer-brand">
                <a href="/home" class="logo-link">
                    <img
                        src="images/logo.webp"
                        alt="Smart Locker System"
                        class="h-[90px]"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                </a>
            </div>

            <nav class="footer-nav">
                <a href="/how-to-use">How to Use</a>
                <a href="/locations">Locations</a>
                <a href="/faq">FAQ</a>
                <a href="/about">About</a>
            </nav>

            <p class="footer-copyright">
                © 2026 Smart Locker System
            </p>

        </div>
    </footer>
</body>
</html>