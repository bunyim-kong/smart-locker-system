<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Smart Locker')</title>
</head>
<body>
    @include('admin.partial.sidebar')

    <div class="admin-container flex-1 flex flex-col min-h-screen">

        @include('admin.partial.header')

        <main class="flex-1 p-6 overflow-y-auto">
            @yield('content')
        </main>
    </div>
</body>
</html>