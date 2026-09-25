@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-6xl mx-auto">

    {{-- Success message --}}
    @if(session('success'))
        <div class="mb-4 px-4 py-2.5 bg-green-50 border border-green-200 text-green-700 text-sm rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- Search / Filter / Add --}}
    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mb-6">
        <div class="relative flex-1">
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
            <input
                type="text"
                id="searchInput"
                placeholder="Search maintenance..."
                class="w-full pl-9 pr-3 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <button type="button"
                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 13.5V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 9.75V10.5" />
            </svg>
            Filter
        </button>

        <a href="{{ route('maintenances.create') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Add Maintenance
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white border border-gray-100 rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="text-left font-medium text-gray-500 text-xs uppercase tracking-wide px-6 py-3">Locker</th>
                    <th class="text-left font-medium text-gray-500 text-xs uppercase tracking-wide px-6 py-3">Issue</th>
                    <th class="text-left font-medium text-gray-500 text-xs uppercase tracking-wide px-6 py-3">Reported</th>
                    <th class="text-left font-medium text-gray-500 text-xs uppercase tracking-wide px-6 py-3">Resolved</th>
                    <th class="text-left font-medium text-gray-500 text-xs uppercase tracking-wide px-6 py-3">Status</th>
                    <th class="text-right font-medium text-gray-500 text-xs uppercase tracking-wide px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($maintenance as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ $item->locker->locker_code ?? 'Locker #' . $item->locker_id }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ $item->issue_des }}
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            {{ $item->report_date ? \Carbon\Carbon::parse($item->report_date)->format('M j, Y') : '-' }}
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            {{ $item->resolve_date ? \Carbon\Carbon::parse($item->resolve_date)->format('M j, Y') : '-' }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($item->resolve_date)
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700">
                                    RESOLVED
                                </span>
                            @else
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-600">
                                    OPEN
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('maintenances.edit', $item->id) }}"
                                   class="text-gray-400 hover:text-blue-600" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('maintenances.destroy', $item->id) }}" method="POST"
                                      onsubmit="return confirm('Delete this maintenance record?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-600" title="Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-400">
                            No maintenance records found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

<script>
    document.getElementById('searchInput').addEventListener('input', function (e) {
        const term = e.target.value.toLowerCase();
        document.querySelectorAll('tbody tr').forEach(function (row) {
            row.style.display = row.textContent.toLowerCase().includes(term) ? '' : 'none';
        });
    });
</script>
@endsection