@extends('layouts.admin')

@section('title', 'Maintenance')

@section('content')
<section>
    @if (session('success'))
        <div role="status" class="mb-4 rounded-lg bg-green-50 px-4 py-2 text-sm text-green-700">{{ session('success') }}</div>
    @endif
    <form action="{{ route('admin.maintenances.index') }}" method="GET" class="mb-4 flex flex-wrap items-center gap-3">
        <div class="relative min-w-48 flex-1">
            <svg aria-hidden="true" class="absolute left-3 top-1/2 size-4 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="search" name="search" value="{{ request('search') }}" aria-label="Search maintenance" placeholder="Search by locker, location or issue..." class="w-full rounded-lg border border-gray-200 py-2 pl-9 pr-4 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <button type="submit" class="rounded-lg border border-gray-200 px-4 py-2 text-sm font-medium hover:bg-gray-50">Search</button>
        <a href="{{ route('admin.maintenances.create') }}" class="flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700"><span aria-hidden="true">+</span> Add maintenance</a>
    </form>
    <div class="overflow-x-auto rounded-xl border border-gray-100 bg-white">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100 text-xs uppercase tracking-wide text-gray-400">
                    @foreach (['Locker', 'Issue', 'Reported by', 'Reported', 'Resolved'] as $heading)
                        <th scope="col" class="px-6 py-3 text-left font-medium">{{ $heading }}</th>
                    @endforeach
                    <th scope="col" class="px-6 py-3 text-right font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($maintenances as $maintenance)
                    <tr class="border-b border-gray-50 last:border-0 hover:bg-gray-50">
                        <td class="px-6 py-4"><p class="font-semibold text-gray-900">{{ $maintenance->locker->name }}</p><p class="mt-1 text-xs text-gray-500">{{ $maintenance->locker->location->name }}</p></td>
                        <td class="max-w-xs px-6 py-4"><p class="line-clamp-2 break-words text-gray-600">{{ $maintenance->issue_des }}</p></td>
                        <td class="px-6 py-4 text-gray-500">{{ $maintenance->user->name }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-gray-500">{{ $maintenance->report_date->format('d M Y') }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-gray-500">{{ $maintenance->resolve_date?->format('d M Y') ?? '—' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('admin.maintenances.show', $maintenance) }}" aria-label="View maintenance {{ $maintenance->id }}" class="text-gray-500 hover:text-gray-700"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg></a>
                                <a href="{{ route('admin.maintenances.edit', $maintenance) }}" aria-label="Edit maintenance {{ $maintenance->id }}" class="text-blue-500 hover:text-blue-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg></a>
                                <form action="{{ route('admin.maintenances.destroy', $maintenance) }}" method="POST" onsubmit="return confirm('Delete this maintenance record?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" aria-label="Delete maintenance {{ $maintenance->id }}" class="text-red-500 hover:text-red-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
                                        </svg></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-6 py-8 text-center text-gray-400">No maintenance records found. <a href="{{ route('admin.maintenances.create') }}" class="underline">Add maintenance</a>.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $maintenances->links() }}</div>
</section>
@endsection
