@extends('layouts.admin')

@section('content')

    {{-- Page header --}}
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1 style="margin: 0; font-size: 24px; font-weight: 600; color: #111827;">Lockers</h1>

        <a href="{{ route('lockers.create') }}"
           style="background: #2563eb; color: #ffffff; padding: 10px 18px; border-radius: 8px; font-size: 14px; font-weight: 600; text-decoration: none;">
            + Add Locker
        </a>
    </div>

    {{-- Success message --}}
    @if (session('success'))
        <div style="background: #dcfce7; color: #166534; padding: 12px 16px; border-radius: 8px; margin-bottom: 16px; font-size: 14px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    <div style="background: #ffffff; border: 1px solid #e5e7eb; border-radius: 12px; overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; font-size: 14px; color: #374151;">

            <thead>
                <tr style="background: #f9fafb;">
                    <th style="padding: 14px 20px; text-align: left; font-size: 12px; font-weight: 600; color: #6b7280; border-bottom: 1px solid #e5e7eb;">LOCKER</th>
                    <th style="padding: 14px 20px; text-align: left; font-size: 12px; font-weight: 600; color: #6b7280; border-bottom: 1px solid #e5e7eb;">LOCATION</th>
                    <th style="padding: 14px 20px; text-align: left; font-size: 12px; font-weight: 600; color: #6b7280; border-bottom: 1px solid #e5e7eb;">STATUS</th>
                    <th style="padding: 14px 20px; text-align: left; font-size: 12px; font-weight: 600; color: #6b7280; border-bottom: 1px solid #e5e7eb;">CREATED</th>
                    <th style="padding: 14px 20px; text-align: right; font-size: 12px; font-weight: 600; color: #6b7280; border-bottom: 1px solid #e5e7eb;">ACTIONS</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($lockers as $locker)
                    @php
                        $statusColor = match ($locker->status) {
                            'Available'   => '#16a34a',
                            'Maintenance' => '#dc2626',
                            default       => '#92400e', // In Use
                        };
                    @endphp

                    <tr>
                        <td style="padding: 18px 20px; font-weight: 600; border-bottom: 1px solid #f0f0f0;">
                            <a href="{{ route('lockers.show', $locker) }}" style="color: #374151; text-decoration: none;">
                                {{ $locker->name }}
                            </a>
                        </td>

                        <td style="padding: 18px 20px; color: #6b7280; border-bottom: 1px solid #f0f0f0;">
                            {{ $locker->location->name ?? '—' }}
                        </td>

                        <td style="padding: 18px 20px; font-weight: 600; color: {{ $statusColor }}; border-bottom: 1px solid #f0f0f0;">
                            {{ $locker->status }}
                        </td>

                        <td style="padding: 18px 20px; font-size: 13px; color: #4b5563; border-bottom: 1px solid #f0f0f0;">
                            {{ $locker->created_at->format('d M Y, h:i A') }}
                        </td>

                        <td style="padding: 18px 20px; text-align: right; border-bottom: 1px solid #f0f0f0; white-space: nowrap;">
                            <div style="display: inline-flex; align-items: center; gap: 12px;">

                                {{-- Edit --}}
                                <a href="{{ route('lockers.edit', $locker) }}" title="Edit" style="display: inline-flex; color: #374151;">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('lockers.destroy', $locker) }}" method="POST" style="margin: 0;"
                                      onsubmit="return confirm('Delete locker {{ $locker->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Delete"
                                            style="background: none; border: none; padding: 0; cursor: pointer; display: inline-flex; color: #dc2626;">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M8 6V4h8v2"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding: 40px 20px; text-align: center; color: #6b7280;">
                            No lockers yet. <a href="{{ route('lockers.create') }}" style="color: #2563eb; font-weight: 600; text-decoration: none;">Add your first locker</a>.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

@endsection