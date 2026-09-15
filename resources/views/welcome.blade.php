<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" type='text/css' href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css" />
</head>
<body>
    <footer>
        <div class="footer-top">
            <a href="#" class="brand">
                <img class="brand-logo" src="{{ asset('css/images/logo.webp') }}" alt="{{ __('SmartLocker Logo') }}">
            </a>
        
            <nav class="footer-links">
                <a href="#">About</a>
                <a href="#">Terms</a>
                <a href="#">Privacy</a>
                <a href="#">Contact</a>
            </nav>
        
            <div class="copyright">© 2025 SmartLocker</div>
        </div>
        
        <hr class="footer-divider">
        
        <div class="footer-bottom">
            <p class="footer-note">
                Secure smart locker rentals compliant with storage space physical safety standards. No credit card required for standard free-tier slots.
            </p>
        
            <div class="socials">
                <div class="social-btn" title="Twitter">
                    <i class="devicon-twitter-original"></i>  
                </div>
                <div class="social-btn" title="Facebook">
                    <i class="devicon-facebook-original"></i>
                </div>
                <div class="social-btn" title="GitHub">
                    <i class="devicon-github-original"></i>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>