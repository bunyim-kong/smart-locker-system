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
                <img src="images/logo.webp" alt="">
            </div>

            <h2>Create your account</h2>

            <p class="register-description">
                Register to start using smart lockers
            </p>

            <form class="register-form" method="POST" action="{{ route('register.store') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Full name</label>
                    <input type="text" id="name" name="name" placeholder="John Doe" value="{{ old('name') }}">
                    @error('name')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

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
                    @error('password')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••">
                </div>

                <label class="terms">
                    <input type="checkbox" name="terms">
                    <span>
                        I agree to the
                        <a href="#">Terms</a>
                        and
                        <a href="#">Privacy Policy</a>.
                    </span>
                </label>
                @error('terms')
                    <span class="form-error">{{ $message }}</span>
                @enderror

                <button type="submit" class="register-submit">
                    Create Account
                </button>

            </form>

            <div class="divider">
                <div></div>
                <span>OR</span>
                <div></div>
            </div>

            <p class="login-text">
                Already have an account?
                <a href="{{ route('login.authentication') }}">Sign in</a>
            </p>

        </div>

        <p class="register-footer">
            © {{ date('Y') }} Smart Locker System
        </p>

    </div>

</body>
</html>