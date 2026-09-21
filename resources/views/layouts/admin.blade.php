<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Smart Locker')</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/sidebar.css') }}">

    <!-- flowbite -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    
</head>
<body>
    <section class="flex">
        @include('admin.partial.sidebar')

        <div class="admin-container flex-1 flex flex-col min-h-screen sm:ml-64">
            @include('admin.partial.header')

            <main class="flex-1 px-6 pt-2 pb-4 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </section>
</body>
</html>