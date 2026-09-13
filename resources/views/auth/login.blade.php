<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register · Smart Locker System</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/register.css') }}">
</head>

<body>

    <div class="register-page">
        <div class="register-card">
            <div class="register-logo">
                <img src="{{ asset('images/logo.webp') }}" alt="">
            </div>

            <h2>Login your account</h2>

            <p class="register-description">
                Welcome back, please login your account
            </p>

            @if (session('status'))
                <p class="form-error">{{ session('status') }}</p>
            @endif

            <form class="register-form" method="POST" action="{{ route('login.authentication') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" value="{{ old('email') }}">
                    @error('email')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••">
                </div>

                <label class="terms">
                    <input type="checkbox" name="remember">
                    <span>Remember me</span>
                </label>

                <button type="submit" class="register-submit">
                    Sign In
                </button>

            </form>

            <div class="divider">
                <div></div>
                <span>OR</span>
                <div></div>
            </div>

            <p class="login-text">
                Don't have an account?
                <a href="{{ route('register') }}">Register</a>
            </p>

        </div>

        <p class="register-footer">
            © {{ date('Y') }} Smart Locker System
        </p>

    </div>

</body>
</html>