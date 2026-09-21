{{-- Use the layout that has your sidebar --}}
@extends('layouts.admin')

@section('title', 'Location details')

@section('content')

{{-- ===== Card ===== --}}
<div class="max-w-[640px] p-6 border border-gray-200 rounded-xl bg-white">

    {{-- Icon + name --}}
    <div class="flex items-center gap-3.5 mb-6">
        <span class="flex items-center justify-center w-11 h-11 rounded-[10px] bg-violet-600 text-white">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
        </span>
        <h2 class="m-0 text-xl font-bold text-gray-900">{{ $location->name }}</h2>
    </div>

    {{-- Details: label on the left, value on the right --}}
    <dl class="grid grid-cols-[110px_1fr] gap-x-4 gap-y-3.5 m-0 text-sm">
        <dt class="text-gray-500">Address</dt>
        <dd class="m-0 min-w-0 text-gray-900 break-words">{{ $location->address }}</dd>

        <dt class="text-gray-500">Map link</dt>
        <dd class="m-0 min-w-0 text-gray-900 break-words">
            <a href="{{ $location->map_link }}" target="_blank" rel="noopener" class="text-[#0a8cf5] underline">{{ $location->map_link }}</a>
        </dd>
    </dl>

    {{-- Buttons --}}
    <div class="flex gap-3 mt-6">
        <a href="{{ route('locations.edit', $location) }}"
           class="inline-flex items-center h-10 px-[18px] border border-[#0a8cf5] rounded-lg bg-[#0a8cf5] text-white text-sm font-medium no-underline">
            Edit
        </a>
        <a href="{{ route('locations.index') }}"
           class="inline-flex items-center h-10 px-[18px] border border-gray-200 rounded-lg bg-white text-gray-900 text-sm font-medium no-underline">
            Back to list
        </a>
    </div>

</div>

@endsection