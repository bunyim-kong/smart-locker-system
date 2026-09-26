{{-- Use the layout that has your sidebar --}}
@extends('layouts.admin')

{{-- This text goes in the top heading of the layout --}}
@section('title', 'Locations')

@section('content')

{{--
    ===== Locker numbers (static, edit by hand) =====
    Your backend isn't sending real "lockers_count" / "available_lockers_count"
    values yet, so until that's fixed, the Total lockers / Available numbers
    come from this simple list instead.

    HOW TO CHANGE A NUMBER:
    Find the location's name below and change 'total' (total lockers) or
    'free' (available lockers) to whatever you want.

    HOW TO ADD A NEW LOCATION'S NUMBERS:
    Add a new line, copying the pattern, with the location's exact name.

    If a location's name isn't listed here, it will just show 0 lockers / 0 free.
--}}
@php
    $lockerCounts = [
        'Central Library' => ['total' => 2, 'free' => 1],
        'Riverside Gym'   => ['total' => 12, 'free' => 3],
        'City Hall'       => ['total' => 15, 'free' => 5],
        'Downtown Mall'   => ['total' => 30, 'free' => 12],
        'Central Station' => ['total' => 25, 'free' => 20],
        'administrator'   => ['total' => 10, 'free' => 4],
        'Sithul'          => ['total' => 8, 'free' => 2],
    ];
@endphp

{{-- ===== Messages ===== --}}
@if (session('success'))
    <div class="px-3.5 py-2.5 mb-4 rounded-lg text-sm bg-[#ecfdf3] text-[#067647]">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="px-3.5 py-2.5 mb-4 rounded-lg text-sm bg-[#fef3f2] text-[#b42318]">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif


{{-- ===== Top bar: search, filter, add ===== --}}
<form method="GET" action="{{ route('locations.index') }}" class="flex items-center gap-3 mb-6">

    {{-- Search box --}}
    <div class="relative flex-1">
        <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
        <input type="search" name="search" value="{{ request('search') }}" placeholder="Search locations..."
               class="w-full h-10 pl-[38px] pr-3 border border-gray-200 rounded-lg bg-white text-sm">
    </div>

    {{-- Filter button --}}
    <details class="relative">
        <summary class="list-none [&::-webkit-details-marker]:hidden inline-flex items-center h-10 px-4 border border-gray-200 rounded-lg bg-white text-gray-900 text-sm font-medium cursor-pointer">
            Filter
        </summary>
        <div class="absolute right-0 top-[46px] z-10 min-w-[240px] p-3.5 bg-white border border-gray-200 rounded-[10px] shadow-[0_8px_24px_rgba(0,0,0,0.08)]">
            <label class="flex items-center gap-2 mb-3 text-sm">
                <input type="checkbox" name="free" value="1" @checked(request()->boolean('free'))>
                Only locations with free lockers
            </label>
            <button type="submit" class="w-full inline-flex items-center justify-center h-10 px-4 border border-[#0a8cf5] rounded-lg bg-[#0a8cf5] text-white text-sm font-medium cursor-pointer">
                Apply
            </button>
        </div>
    </details>

    {{-- Add button: opens the create page --}}
    <a href="{{ route('locations.create') }}"
       class="inline-flex items-center h-10 px-4 border border-[#0a8cf5] rounded-lg bg-[#0a8cf5] text-white text-sm font-medium no-underline cursor-pointer">
        + Add location
    </a>
</form>


{{-- ===== Table ===== --}}
<div class="border border-gray-200 rounded-xl bg-white">
    <table class="w-full border-collapse text-sm">
        <thead>
            <tr>
                <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase text-gray-500 bg-[#faf9f7] border-b border-gray-200 first:rounded-tl-xl">Location</th>
                <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase text-gray-500 bg-[#faf9f7] border-b border-gray-200">Address</th>
                <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase text-gray-500 bg-[#faf9f7] border-b border-gray-200">Total lockers</th>
                <th class="px-6 py-3.5 text-left text-xs font-semibold uppercase text-gray-500 bg-[#faf9f7] border-b border-gray-200">Available</th>
                <th class="px-6 py-3.5 text-right text-xs font-semibold uppercase text-gray-500 bg-[#faf9f7] border-b border-gray-200 last:rounded-tr-xl">Actions</th>
            </tr>
        </thead>

        {{-- [&>tr:last-child>td]:border-b-0 removes the line under the last row --}}
        <tbody class="[&>tr:last-child>td]:border-b-0">
            @forelse ($locations as $location)
                {{-- Look up this location's numbers from the list above --}}
                @php
                    $counts = $lockerCounts[$location->name] ?? ['total' => 0, 'free' => 0];
                @endphp
                <tr>
                    {{-- Name (click to open the full-screen detail page) --}}
                    <td class="px-6 py-3.5 border-b border-gray-200">
                        <a href="{{ route('locations.show', $location) }}" class="flex items-center gap-3 font-semibold text-gray-900 no-underline">
                            <span class="flex items-center justify-center w-8 h-8 rounded-lg bg-[#0a8cf5] text-white">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                            </span>
                            {{ $location->name }}
                        </a>
                    </td>

                    {{-- Address --}}
                    <td class="px-6 py-3.5 border-b border-gray-200 text-gray-500">{{ $location->address }}</td>

                    {{-- Total lockers: "1 locker" / "13 lockers" / "24 lockers" --}}
                    <td class="px-6 py-3.5 border-b border-gray-200">
                        {{ $counts['total'] }} {{ \Illuminate\Support\Str::plural('locker', $counts['total']) }}
                    </td>

                    {{-- Free lockers (gray when it is 0) --}}
                    <td class="px-6 py-3.5 border-b border-gray-200">
                        <span class="inline-flex items-center gap-2 font-semibold before:content-[''] before:w-[7px] before:h-[7px] before:rounded-full before:bg-current {{ $counts['free'] == 0 ? 'text-green-400' : 'text-green-600' }}">
                            {{ $counts['free'] }} free
                        </span>
                    </td>

                    {{-- Actions: View, Edit, Delete --}}
                    <td class="px-6 py-4 border-b border-gray-200">
    <div class="flex items-center justify-end gap-3">
        {{-- View: opens the full-screen detail page --}}
        <a href="{{ route('locations.show', $location) }}" class="text-gray-500 hover:text-gray-700">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </a>

        <a href="{{ route('locations.edit', $location) }}" class="text-blue-500 hover:text-blue-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
        </a>

        <form action="{{ route('locations.destroy', $location) }}" method="POST" onsubmit="return confirm('Delete this location?')">
            @csrf @method('DELETE')
            <button type="submit" class="text-red-500 hover:text-red-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
                </svg>
            </button>
        </form>
    </div>
</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                        No locations found. <a href="{{ route('locations.create') }}" class="underline">Add a location</a>.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


<script>
    // Close the open "..." menu when you click somewhere else
    document.addEventListener('click', function (event) {
        document.querySelectorAll('[data-menu][open]').forEach(function (menu) {
            if (!menu.contains(event.target)) {
                menu.removeAttribute('open');
            }
        });
    });
</script>

@endsection