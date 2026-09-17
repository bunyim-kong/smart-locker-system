{{--
    resources/views/admin/partial/header.blade.php

    Include from your layout (e.g. resources/views/layouts/admin.blade.php):
        @include('admin.partial.header')

    Stylesheet: public/css/components/header.css
    Add this once in your layout's <head>:
        <link rel="stylesheet" href="{{ asset('css/components/header.css') }}">

    Static version: no auth(), no dynamic title, no JS. Everything is hardcoded.
--}}

<header class="admin-header">
    <h1 class="admin-header__title">Dashboard</h1>

    <div class="admin-header__user">
        <span class="admin-header__avatar">JO</span>
        <span class="admin-header__name">Sithul</span>
        <svg class="admin-header__chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
        </svg>
    </div>
</header>