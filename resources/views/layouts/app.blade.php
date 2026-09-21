<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Smart Locker')</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}">
</head>
<body>
    @include('user.partials.navbar')

    <main class="mx-auto mb-6 mt-[88px] w-full max-w-7xl max-md:px-[30px]">
        @yield('content');
    </main>

    
    @include('user.partials.footer')
</html>