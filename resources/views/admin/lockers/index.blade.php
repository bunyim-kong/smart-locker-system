@extends('layouts.admin')

@section('title', 'Lockers')

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

    <form action="{{ route('admin.lockers.index') }}" method="GET" class="mb-4 flex flex-wrap items-center gap-3">
        <div class="relative min-w-48 flex-1">
            <svg aria-hidden="true" class="absolute left-3 top-1/2 size-4 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input type="search" name="search" value="{{ request('search') }}" aria-label="Search lockers" placeholder="Search by locker name or location..."
                   class="w-full rounded-lg border border-gray-200 py-2 pl-9 pr-4 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <select name="status" aria-label="Filter by status" class="rounded-lg border border-gray-200 px-3 py-2 text-sm">
            <option value="">All statuses</option>
            @foreach (['Available', 'In Use', 'Maintenance'] as $status)
                <option value="{{ $status }}" @selected(request('status') === $status)>{{ $status }}</option>
            @endforeach
        </select>
        <button type="submit" class="rounded-lg border border-gray-200 px-4 py-2 text-sm font-medium hover:bg-gray-50">Filter</button>

        <a href="{{ route('admin.lockers.create') }}"
           class="flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
            <svg aria-hidden="true" class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add locker
        </a>
    </form>

    <div class="overflow-x-auto rounded-xl border border-gray-100 bg-white">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100 text-xs uppercase tracking-wide text-gray-400">
                    <th scope="col" class="px-6 py-3 text-left font-medium">Locker</th>
                    <th scope="col" class="px-6 py-3 text-left font-medium">Location</th>
                    <th scope="col" class="px-6 py-3 text-left font-medium">Status</th>
                    <th scope="col" class="px-6 py-3 text-left font-medium">Updated</th>
                    <th scope="col" class="px-6 py-3 text-right font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($lockers as $locker)
                    <tr class="border-b border-gray-50 last:border-0 hover:bg-gray-50">
                        <td class="flex items-center gap-3 px-6 py-4 font-semibold text-gray-900">

                            {{ $locker->name }}
                        </td>
                        <td class="px-6 py-4 text-gray-500">{{ $locker->location->name ?? '—' }}</td>
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
                            {{ $locker->updated_at->diffForHumans() }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('user.lockers.show', $locker) }}" aria-label="View locker {{ $locker->name }}" class="text-gray-500 hover:text-gray-700">
                                    <svg aria-hidden="true" class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </a>
                                <a href="{{ route('admin.lockers.edit', $locker) }}" aria-label="Edit locker {{ $locker->name }}" class="text-blue-500 hover:text-blue-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.lockers.destroy', $locker) }}" method="POST" onsubmit="return confirm('Delete this locker?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" aria-label="Delete locker {{ $locker->name }}" class="text-red-500 hover:text-red-600">
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
                        <td colspan="5" class="px-6 py-6 text-center text-gray-400">No lockers yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
