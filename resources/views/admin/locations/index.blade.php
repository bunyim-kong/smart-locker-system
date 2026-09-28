@extends('layouts.admin')

@section('title', 'Locations')

@section('content')
<section>
    @if ($errors->any())
        <p role="alert" class="mb-4 rounded-lg border border-[var(--color-danger)] p-4 text-sm">{{ $errors->first() }}</p>
    @endif

    @if (session('success'))
        <div class="mb-4 px-4 py-2 bg-green-50 text-green-700 text-sm rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.locations.index') }}" method="GET" class="flex flex-wrap items-center gap-3 mb-4">
        <div class="relative flex-1">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input type="search" name="search" value="{{ request('search') }}" aria-label="Search locations" placeholder="Search by location name or address..."
                   class="w-full pl-9 pr-4 py-2 border border-gray-200 rounded-lg text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <select name="free" aria-label="Filter locations" class="rounded-lg border border-gray-200 px-3 py-2 text-sm">
            <option value="">All locations</option>
            <option value="1" @selected(request()->boolean('free'))>Only with free lockers</option>
        </select>
        <button type="submit" class="rounded-lg border border-gray-200 px-4 py-2 text-sm font-medium hover:bg-gray-50">Filter</button>

        <a href="{{ route('admin.locations.create') }}"
           class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add location
        </a>
    </form>

    <div class="bg-white border border-gray-100 rounded-xl overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100 text-xs text-gray-400 uppercase tracking-wide">
                    <th class="text-left font-medium px-6 py-3">Location</th>
                    <th class="text-left font-medium px-6 py-3">Address</th>
                    <th class="text-left font-medium px-6 py-3">Total lockers</th>
                    <th class="text-left font-medium px-6 py-3">Available</th>
                    <th class="text-right font-medium px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($locations as $location)
                    @php
                        $total = $location->lockers->count();
                        $free = $location->lockers->where('status', 'Available')->count();
                    @endphp
                    <tr class="border-b border-gray-50 last:border-0 hover:bg-gray-50">
                        <td class="flex items-center gap-3 px-6 py-4 font-semibold text-gray-900">
                            <span class="flex items-center justify-center w-8 h-8 rounded-lg bg-[#0a8cf5] text-white">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                            </span>
                            {{ $location->name }}
                        </td>
                        <td class="px-6 py-4 text-gray-500">{{ $location->address ?? '—' }}</td>
                        <td class="px-6 py-4 text-gray-500">
                            {{ $total }} {{ \Illuminate\Support\Str::plural('locker', $total) }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-medium {{ $free > 0 ? 'text-green-600' : 'text-gray-400' }}">
                                {{ $free }} free
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('user.locations.show', $location) }}" aria-label="View location" class="text-gray-500 hover:text-gray-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </a>
                                <a href="{{ route('admin.locations.edit', $location) }}" aria-label="Edit location" class="text-blue-500 hover:text-blue-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.locations.destroy', $location) }}" method="POST" onsubmit="return confirm('Delete this location?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" aria-label="Delete location" class="text-red-500 hover:text-red-600">
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
                        <td colspan="5" class="px-6 py-6 text-center text-gray-400">
                            No locations found. <a href="{{ route('admin.locations.create') }}" class="underline">Add a location</a>.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection