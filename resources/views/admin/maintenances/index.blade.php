<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Maintenance Management</title>
</head>

<body>

<div style="max-width: 1000px; margin: 40px auto;">

    <h1>Maintenance Management</h1>

    {{-- Success message --}}
    @if(session('success'))

        <p style="color: green;">
            {{ session('success') }}
        </p>

    @endif

    {{-- Add Maintenance --}}
    <a href="{{ route('maintenances.create') }}">
        + Add Maintenance
    </a>

    <br><br>

    <table
        border="1"
        cellpadding="10"
        cellspacing="0"
        width="100%"
    >

        <thead>

            <tr>
                <th>ID</th>
                <th>Locker ID</th>
                <th>User ID</th>
                <th>Issue Des</th>
                <th>Reported Date</th>
                <th>Resolve Date</th>
            </tr>

        </thead>

         <tbody>
            @forelse ($maintenance as $maintenances)
                <tr>
                    <td>{{ $maintenance->id }}</td>
                    <td>{{ $maintenance->locker->locker_code ?? 'Locker #' . $maintenance->locker_id }}</td>
                    <td>{{ $maintenance->issue_des }}</td>
                    <td>{{ $maintenance->report_date ? \Carbon\Carbon::parse($maintenance->report_date)->format('Y-m-d') : '-' }}</td>
                    <td>{{ $maintenance->resolve_date ? \Carbon\Carbon::parse($maintenance->resolve_date)->format('Y-m-d') : '-' }}</td>
                    <td>
                        <a href="{{ route('maintenances.edit', $maintenance->id) }}">Edit</a>
 
                        <form action="{{ route('maintenances.destroy', $maintenance->id) }}" method="POST" style="display:inline"
                              onsubmit="return confirm('Delete this maintenance record?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No maintenance records found.</td>
                </tr>
            @endforelse
        </tbody>

    </table>

</div>

</body>

</html>