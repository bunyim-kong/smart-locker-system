<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Smart Locker')</title>

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/stat-card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/location-card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/locker-card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/location.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/locker.css') }}">
</head>
<body>
    
    @include('front.partials.navbar')

    <main>
        @yield('content');
    </main>

    
    @include('front.partials.footer')
</body>
</html>