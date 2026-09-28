@extends('layouts.admin')

@section('title', 'Location details')

@section('content')
<section class="w-full">
    <div class="flex items-center gap-2 mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Location {{ $location->name }}</h1>
    </div>

    <div class="bg-white border border-gray-100 rounded-xl p-8 w-full">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex items-center gap-3">
                <span class="flex items-center justify-center w-8 h-8 rounded-lg bg-[#0a8cf5] text-white">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z" />
                        <circle cx="12" cy="10" r="3" />
                    </svg>
                </span>

                <p class="text-sm text-gray-900">{{ $location->name }}</p>
            </div>

            <div>
                <p class="block text-sm font-bold text-gray-700 mb-1">Address</p>
                <p class="text-sm text-gray-900 break-words">{{ $location->address ?? '—' }}</p>
            </div>

            <div class="md:col-span-2">
                <p class="block text-sm font-bold text-gray-700 mb-1">Map link</p>
                @if ($location->map_link)
                    <a href="{{ $location->map_link }}" target="_blank" rel="noopener"
                       class="text-sm text-blue-600 hover:text-blue-700 underline break-words">
                        {{ $location->map_link }}
                    </a>
                @else
                    <p class="text-sm text-gray-400">—</p>
                @endif
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-8">
            <a href="{{ route('admin.locations.index') }}"
               class="px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                Back to list
            </a>
            <a href="{{ route('admin.locations.edit', $location) }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700">
                Edit
            </a>
        </div>
    </div>
</section>
@endsection