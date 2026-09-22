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
        <div class="relative flex-1">
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by locker name or location..."
                   class="w-full pl-9 pr-4 py-2 border border-gray-200 rounded-lg text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="relative">
            <i class="fa-solid fa-filter absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm pointer-events-none"></i>
            <select name="status" onchange="this.form.submit()"
                    class="appearance-none pl-9 pr-8 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">All statuses</option>
                @foreach (['Available', 'In Use', 'Maintenance'] as $status)
                    <option value="{{ $status }}" @selected(request('status') == $status)>{{ $status }}</option>
                @endforeach
            </select>
        </div>

        @if (request('search') || request('status'))
            <a href="{{ route('lockers.index') }}" class="text-sm text-gray-400 hover:text-gray-600">
                <i class="fa-solid fa-xmark mr-1"></i>Clear
            </a>
        @endif

        <a href="{{ route('lockers.create') }}"
           class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 ml-auto">
            <i class="fa-solid fa-plus text-xs"></i>
            Add locker
        </a>
    </form>

    <div class="bg-white border border-gray-100 rounded-xl overflow-hidden">
        <table class="w-full text-sm table-fixed">
            <thead>
                <tr class="border-b border-gray-100 text-xs text-gray-400 uppercase tracking-wide">
                    <th class="w-[18%] text-left font-medium px-6 py-3">Locker</th>
                    <th class="w-[16%] text-left font-medium px-6 py-3">Location</th>
                    <th class="w-[16%] text-left font-medium px-6 py-3">Status</th>
                    <th class="w-[26%] text-left font-medium px-6 py-3">Detail</th>
                    <th class="w-[24%] text-right font-medium px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($lockers as $locker)
                    <tr class="border-b border-gray-50 last:border-0 hover:bg-gray-50">
                        <td class="w-[18%] px-6 py-4 font-semibold text-gray-900 truncate">{{ $locker->name }}</td>
                        <td class="w-[16%] px-6 py-4 text-gray-500 truncate">{{ $locker->location->name ?? '—' }}</td>
                        <td class="w-[16%] px-6 py-4">
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
                        <td class="w-[26%] px-6 py-4 text-gray-500 truncate">
                            Updated {{ $locker->updated_at->diffForHumans() }}
                        </td>
                        <td class="w-[24%] px-6 py-4">
                            <div class="flex items-center justify-end gap-5">
                                <a href="{{ route('lockers.show', $locker) }}" class="text-gray-500 hover:text-gray-700 text-base">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('lockers.edit', $locker) }}" class="text-blue-500 hover:text-blue-600 text-base">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('lockers.destroy', $locker) }}" method="POST" onsubmit="return confirm('Delete this locker?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-600 text-base">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-6 text-center text-gray-400">No lockers match your search.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection