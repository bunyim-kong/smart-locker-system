@extends('layouts.admin')

@section('content')

    @php
        $statusColor = match ($locker->status) {
            'Available'   => '#16a34a',
            'Maintenance' => '#dc2626',
            default       => '#92400e',
        };

        $details = [
            'Location'            => $locker->location->name ?? '—',
            'Size'                => $locker->size ?? '—',
            'Status'              => $locker->status,
            'Usage records'       => $locker->history->count(),
            'Maintenance records' => $locker->maintenance->count(),
            'Created'             => $locker->created_at->format('d M Y, h:i A'),
            'Last updated'        => $locker->updated_at->format('d M Y, h:i A'),
        ];
    @endphp

    <h1 style="margin: 0 0 24px; font-size: 26px; font-weight: 700; color: #1f2937;">Locker {{ $locker->name }}</h1>

    <div style="max-width: 520px; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 12px; padding: 8px 28px;">

        @foreach ($details as $title => $value)
            <div style="display: flex; justify-content: space-between; padding: 16px 0; font-size: 14px;">
                <span style="color: #6b7280;">{{ $title }}</span>

                @if ($title === 'Status')
                    <span style="font-weight: 600; ">{{ $value }}</span>
                @else
                    <span style="font-weight: 600; color: #374151;">{{ $value }}</span>
                @endif
            </div>
        @endforeach

    </div>

    {{-- Buttons --}}
    <div style="display: flex; gap: 12px; margin-top: 20px;">
        <a href="{{ route('lockers.edit', $locker) }}"
           style="padding: 10px 20px; background: #2563eb; color: #ffffff; border-radius: 8px; font-size: 14px; font-weight: 600; text-decoration: none;">
            Edit locker
        </a>

        <a href="{{ route('lockers.index') }}"
           style="padding: 10px 20px; background: #ffffff; color: #374151; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; font-weight: 600; text-decoration: none;">
            Back
        </a>

        <form action="{{ route('lockers.destroy', $locker) }}" method="POST" style="margin: 0;"
              onsubmit="return confirm('Delete locker {{ $locker->name }}?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    style="padding: 10px 20px; background: #ffffff; color: #dc2626; border: 1px solid #fecaca; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;">
                Delete
            </button>
        </form>
    </div>

@endsection