{{-- resources/views/admin/lockers/show.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="p-6">

    @if (session('success'))
        <div class="mb-4 px-4 py-2 bg-green-50 text-green-700 text-sm rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-between mb-6">
        <a href="{{ route('lockers.index') }}" class="text-sm text-gray-500 hover:text-gray-700 flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to lockers
        </a>

    </div>

    @php
        $statusBadge = [
            'In Use' => 'bg-orange-50 text-orange-600',
            'Available' => 'bg-green-50 text-green-600',
            'Maintenance' => 'bg-red-50 text-red-600',
        ];
    @endphp

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Main info --}}
        <div class="lg:col-span-2 bg-white border border-gray-100 rounded-xl p-8">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-16 h-16 rounded-xl bg-blue-50 flex items-center justify-center">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 1.657-1.343 3-3 3s-3-1.343-3-3 1.343-3 3-3 3 1.343 3 3zm0 0v6m9-6a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-semibold text-gray-900">{{ $locker->name }}</h1>
                    <span class="inline-block mt-1 text-xs font-medium px-2 py-1 rounded-full {{ $statusBadge[$locker->status] ?? 'bg-gray-50 text-gray-500' }}">
                        {{ $locker->status }}
                    </span>
                </div>
            </div>

            <dl class="grid grid-cols-2 gap-y-6 gap-x-6 text-sm">
                <div>
                    <dt class="text-gray-400 mb-1">Location</dt>
                    <dd class="text-gray-900 font-medium">{{ $locker->location->name ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-gray-400 mb-1">Status</dt>
                    <dd class="text-gray-900 font-medium">{{ $locker->status }}</dd>
                </div>
                <div>
                    <dt class="text-gray-400 mb-1">Created</dt>
                    <dd class="text-gray-900 font-medium">{{ $locker->created_at->format('M d, Y H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-gray-400 mb-1">Last updated</dt>
                    <dd class="text-gray-900 font-medium">{{ $locker->updated_at->diffForHumans() }}</dd>
                </div>
            </dl>
        </div>

        {{-- Side panel --}}
        <div class="bg-white border border-gray-100 rounded-xl p-6 h-fit">
            <h2 class="text-sm font-semibold text-gray-900 mb-4">Quick actions</h2>
            <div class="flex flex-col gap-2">
                <a href="{{ route('lockers.edit', $locker) }}"
                   class="w-full text-center px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Edit locker
                </a>
                <a href="{{ route('lockers.index') }}"
                   class="w-full text-center px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Back to list
                </a>
                <form action="{{ route('lockers.destroy', $locker) }}" method="POST" onsubmit="return confirm('Delete this locker?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full px-4 py-2 border border-red-200 text-red-600 rounded-lg text-sm font-medium hover:bg-red-50">
                        Delete locker
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection