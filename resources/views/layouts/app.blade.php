<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Smart Locker')</title>

    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body class="flex min-h-dvh flex-col">
    @include('user.partials.navbar')

    <main class="min-w-0 flex-1 wrap-anywhere">
        @yield('content')
    </main>

    
    @include('user.partials.footer')
</body>
</html>