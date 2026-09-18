<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Locker Management</title>
</head>

<body>

<div style="max-width: 1000px; margin: 40px auto;">

    <h1>Locker Management</h1>

    {{-- Success message --}}
    @if(session('success'))

        <p style="color: green;">
            {{ session('success') }}
        </p>

    @endif

    {{-- Add Locker --}}
    <a href="{{ route('lockers.create') }}">
        + Add Locker
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
                <th>Name</th>
                <th>Status</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>

        </thead>

        <tbody>

        @forelse($lockers as $locker)

            <tr>

                <td>
                    {{ $locker->id }}
                </td>

                <td>
                    {{ $locker->name }}
                </td>

                <td>
                    {{ $locker->status }}
                </td>

                <td>
                    {{ $locker->location->name ?? 'No Location' }}
                </td>

                <td>

                    {{-- View --}}
                    <a href="{{ route('lockers.show', $locker->id) }}">
                        View
                    </a>

                    |

                    {{-- Edit --}}
                    <a href="{{ route('lockers.edit', $locker->id) }}">
                        Edit
                    </a>

                    |

                    {{-- Delete --}}
                    <form
                        action="{{ route('lockers.destroy', $locker->id) }}"
                        method="POST"
                        style="display: inline;"
                    >

                        @csrf

                        @method('DELETE')

                        <button
                            type="submit"
                            onclick="return confirm('Are you sure you want to delete this locker?')"
                        >
                            Delete
                        </button>

                    </form>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="5">
                    No lockers found.
                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

</body>

</html>