{{-- Use the layout that has your sidebar --}}
@extends('layouts.admin')

{{-- This text goes in the top heading of the layout --}}
@section('title', 'Locations')

@section('content')

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
                <tr>
                    {{-- Name (click to open the show page) --}}
                    <td class="px-6 py-3.5 border-b border-gray-200">
                        <a href="{{ route('locations.show', $location) }}" class="flex items-center gap-3 font-semibold text-gray-900 no-underline">
                            <span class="flex items-center justify-center w-8 h-8 rounded-lg bg-violet-600 text-white">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                            </span>
                            {{ $location->name }}
                        </a>
                    </td>

                    {{-- Address --}}
                    <td class="px-6 py-3.5 border-b border-gray-200 text-gray-500">{{ $location->address }}</td>

                    {{-- Total lockers --}}
                    <td class="px-6 py-3.5 border-b border-gray-200">{{ $location->lockers_count }} lockers</td>

                    {{-- Free lockers (gray when it is 0) --}}
                    <td class="px-6 py-3.5 border-b border-gray-200">
                        <span class="inline-flex items-center gap-2 font-semibold before:content-[''] before:w-[7px] before:h-[7px] before:rounded-full before:bg-current {{ $location->available_lockers_count == 0 ? 'text-green-400' : 'text-green-600' }}">
                            {{ $location->available_lockers_count }} free
                        </span>
                    </td>

                    {{-- Actions: View, Edit, Delete --}}
                    <td class="px-6 py-3.5 border-b border-gray-200 text-right">
                        <details class="relative" data-menu>
                            <summary class="list-none [&::-webkit-details-marker]:hidden inline-flex items-center justify-center w-8 h-8 rounded-md text-gray-500 hover:bg-gray-100 cursor-pointer">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><circle cx="5" cy="12" r="1.6"/><circle cx="12" cy="12" r="1.6"/><circle cx="19" cy="12" r="1.6"/></svg>
                            </summary>

                            <div class="absolute right-0 top-9 z-10 min-w-[140px] p-1.5 bg-white border border-gray-200 rounded-[10px] shadow-[0_8px_24px_rgba(0,0,0,0.08)] text-left">
                                <a href="{{ route('locations.show', $location) }}"
                                   class="block w-full px-2.5 py-2 rounded-md text-sm text-gray-900 text-left no-underline hover:bg-gray-100">View</a>
                                <a href="{{ route('locations.edit', $location) }}"
                                   class="block w-full px-2.5 py-2 rounded-md text-sm text-gray-900 text-left no-underline hover:bg-gray-100">Edit</a>

                                <form action="{{ route('locations.destroy', $location) }}" method="POST" class="m-0"
                                      onsubmit="return confirm('Delete this location?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="block w-full px-2.5 py-2 rounded-md text-sm text-[#b42318] text-left cursor-pointer hover:bg-gray-100">Delete</button>
                                </form>
                            </div>
                        </details>
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