{{-- resources/views/admin/lockers/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="p-6">
    <!-- <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Lockers</h1>
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-full bg-gray-700 text-white flex items-center justify-center text-sm font-medium">
                {{ Auth::user()->initials ?? 'AM' }}
            </div>
            <span class="text-sm font-medium text-gray-800">{{ Auth::user()->name ?? 'Alex Morgan' }}</span>
        </div>
    </div> -->

    @if (session('success'))
        <div class="mb-4 px-4 py-2 bg-green-50 text-green-700 text-sm rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center gap-3 mb-4">
        <div class="relative flex-1">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input type="text" placeholder="Search by locker name or location..."
                   class="w-full pl-9 pr-4 py-2 border border-gray-200 rounded-lg text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button class="flex items-center gap-2 px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h18M6 8h12M9 12h6M11 16h2" />
            </svg>
            Filter
        </button>

        <a href="{{ route('lockers.create') }}"
           class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add locker
        </a>
    </div>

    <div class="bg-white border border-gray-100 rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100 text-xs text-gray-400 uppercase tracking-wide">
                    <th class="text-left font-medium px-6 py-3">Locker</th>
                    <th class="text-left font-medium px-6 py-3">Location</th>
                    <th class="text-left font-medium px-6 py-3">Size</th>
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
                        <td class="px-6 py-4 text-gray-500">{{ $locker->size }}</td>
                        <td class="px-6 py-4">
                            @php
                                $statusStyles = [
                                    'In Use' => 'text-orange-500',
                                    'Available' => 'text-green-600',
                                    'Maintenance' => 'text-red-500',
                                ];
                            @endphp
                            <span class="font-medium {{ $statusStyles[$locker->status] ?? 'text-gray-500' }}">
                                {{ $locker->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-500">
                            Updated {{ $locker->updated_at->diffForHumans() }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-3">
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
                        <td colspan="6" class="px-6 py-6 text-center text-gray-400">No lockers yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection