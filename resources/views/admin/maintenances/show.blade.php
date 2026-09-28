@extends('layouts.admin')

@section('title', 'Maintenance Details')

@section('content')
<div class="w-full p-4 sm:p-6">
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.maintenances.index') }}" class="text-gray-400 hover:text-gray-600"><span aria-hidden="true">&larr;</span><span class="sr-only">Back to maintenance</span></a>
            <h1 class="text-2xl font-bold text-gray-900">Maintenance #{{ $maintenance->id }}</h1>
        </div>
        <a href="{{ route('admin.maintenances.edit', $maintenance) }}" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Edit maintenance</a>
    </div>
    <div class="rounded-xl border border-gray-100 bg-white p-5 sm:p-8">
        <dl class="grid grid-cols-1 gap-6 text-sm md:grid-cols-2">
            <div><dt class="text-gray-500">Locker</dt><dd class="mt-1 font-semibold text-gray-900">{{ $maintenance->locker->name }} · {{ $maintenance->locker->location->name }}</dd></div>
            <div><dt class="text-gray-500">Reported by</dt><dd class="mt-1 text-gray-900">{{ $maintenance->user->name }}</dd></div>
            <div><dt class="text-gray-500">Report date</dt><dd class="mt-1 text-gray-900">{{ $maintenance->report_date->format('d M Y') }}</dd></div>
            <div><dt class="text-gray-500">Resolution date</dt><dd class="mt-1 text-gray-900">{{ $maintenance->resolve_date?->format('d M Y') ?? 'Not resolved yet' }}</dd></div>
            <div class="md:col-span-2"><dt class="text-gray-500">Issue description</dt><dd class="mt-2 whitespace-pre-wrap break-words text-gray-900">{{ $maintenance->issue_des }}</dd></div>
        </dl>
        <p class="mt-8 border-t border-gray-100 pt-4 text-sm text-gray-500">This report tracks the issue only. <a href="{{ route('admin.lockers.edit', $maintenance->locker) }}" class="text-blue-600 underline">Manage locker availability</a> separately.</p>
    </div>
</div>
@endsection
