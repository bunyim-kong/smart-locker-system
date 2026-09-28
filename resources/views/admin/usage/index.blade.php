@extends('layouts.admin')

@section('title', 'Usage & History')

@section('content')
<section class="space-y-8">
    @if ($errors->any())
        <p role="alert" class="rounded-lg border border-[var(--color-danger)] p-4 text-sm">{{ $errors->first() }}</p>
    @endif

    @if (session('success'))
        <div class="px-4 py-2 bg-green-50 text-green-700 text-sm rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- Currently in use --}}
    <section>
        <h2 class="text-base font-semibold text-gray-900 mb-3">
            Currently in use
            <span class="ml-1 text-sm font-normal text-gray-400">({{ $activeUsage->count() }})</span>
        </h2>

        <div class="bg-white border border-gray-100 rounded-xl overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100 text-xs text-gray-400 uppercase tracking-wide">
                        <th class="text-left font-medium px-6 py-3">User</th>
                        <th class="text-left font-medium px-6 py-3">Locker</th>
                        <th class="text-left font-medium px-6 py-3">Location</th>
                        <th class="text-left font-medium px-6 py-3">Started</th>
                        <th class="text-left font-medium px-6 py-3">Running for</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($activeUsage as $usage)
                        <tr class="border-b border-gray-50 last:border-0 hover:bg-gray-50">
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $usage->user->name ?? '—' }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $usage->locker->name ?? '—' }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $usage->locker->location->name ?? '—' }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $usage->start_time->format('d M Y, H:i') }}</td>
                            <td class="px-6 py-4">
                                <span class="font-medium text-orange-500">
                                    {{ $usage->start_time->diffForHumans(null, true) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-6 text-center text-gray-400">No lockers are in use right now.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <section>
        <h2 class="text-base font-semibold text-gray-900 my-3">History</h2>

        <div class="bg-white border border-gray-100 rounded-xl overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100 text-xs text-gray-400 uppercase tracking-wide">
                        <th class="text-left font-medium px-6 py-3">User</th>
                        <th class="text-left font-medium px-6 py-3">Locker</th>
                        <th class="text-left font-medium px-6 py-3">Location</th>
                        <th class="text-left font-medium px-6 py-3">Start</th>
                        <th class="text-left font-medium px-6 py-3">End</th>
                        <th class="text-left font-medium px-6 py-3">Duration</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pastUsage as $usage)
                        <tr class="border-b border-gray-50 last:border-0 hover:bg-gray-50">
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $usage->user->name ?? '—' }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $usage->locker->name ?? '—' }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $usage->locker->location->name ?? '—' }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $usage->start_time->format('d M Y, H:i') }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $usage->end_time->format('d M Y, H:i') }}</td>
                            <td class="px-6 py-4">
                                <span class="font-medium text-green-600">
                                    {{ $usage->start_time->diffForHumans($usage->end_time, true) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-6 text-center text-gray-400">No history yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $pastUsage->links() }}
        </div>
    </section>
</section>
@endsection