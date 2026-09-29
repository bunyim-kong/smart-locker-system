{{-- resources/views/admin/lockers/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="p-6">

    @if (session('success'))
        <div class="mb-4 px-4 py-2 bg-green-50 text-green-700 text-sm rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('lockers.index') }}" class="flex items-center gap-3 mb-4">
        {{-- Search --}}
        <div class="relative flex-1">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by locker name or location..."
                   class="w-full pl-9 pr-4 py-2 border border-gray-200 rounded-lg text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        {{-- Status filter --}}
        <div class="relative w-40">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 pointer-events-none {{ request('status') ? 'text-blue-600' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h18M6 8h12M9 12h6M11 16h2" />
            </svg>
            <select name="status" onchange="this.form.submit()"
                    class="w-full appearance-none pl-9 pr-8 py-2 rounded-lg text-sm font-medium cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500
                           {{ request('status') ? 'border border-blue-200 bg-blue-50 text-blue-700' : 'border border-gray-200 bg-white text-gray-600 hover:bg-gray-50' }}">
                <option value="">All status</option>
                @foreach (['Available', 'In Use', 'Maintenance'] as $s)
                    <option value="{{ $s }}" @selected(request('status') === $s)>{{ $s }}</option>
                @endforeach
            </select>
            <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 pointer-events-none {{ request('status') ? 'text-blue-600' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div>

        @if (request('search') || request('status'))
            <a href="{{ route('lockers.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Clear</a>
        @endif

        <a href="{{ route('lockers.create') }}"
           class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add locker
        </a>
    </form>

    @php
        $statusStyles = [
            'In Use' => 'text-orange-500',
            'Available' => 'text-green-600',
            'Maintenance' => 'text-red-500',
        ];
    @endphp

    <div class="bg-white border border-gray-100 rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100 text-xs text-gray-400 uppercase tracking-wide">
                    <th class="text-left font-medium px-6 py-3">Locker</th>
                    <th class="text-left font-medium px-6 py-3">Location</th>
                    <th class="text-left font-medium px-6 py-3">Status</th>
                    <th class="text-left font-medium px-6 py-3">Detail</th>
                    <th class="text-right font-medium px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($lockers as $locker)
                    <tr class="border-b border-gray-50 last:border-0 hover:bg-gray-50">
                        <td class="px-6 py-4 font-semibold text-gray-900">{{ $locker->name }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $locker->location->name ?? '—' }}</td>
                        <td class="px-6 py-4">
                            <span class="font-medium {{ $statusStyles[$locker->status] ?? 'text-gray-500' }}">
                                {{ $locker->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('lockers.show', $locker) }}" class="text-gray-400 hover:text-blue-600">
                                Updated {{ $locker->updated_at->diffForHumans() }}
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('lockers.show', $locker) }}" class="text-gray-500 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                <a href="{{ route('lockers.edit', $locker) }}" class="text-blue-500 hover:text-blue-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="{{ route('lockers.destroy', $locker) }}" method="POST" onsubmit="return confirm('Delete this locker?')">
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
                        <td colspan="5" class="px-6 py-6 text-center text-gray-400">No lockers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection