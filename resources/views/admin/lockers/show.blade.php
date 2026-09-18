<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Locker Details</title>
</head>

<body>

<div style="max-width: 600px; margin: 40px auto;">

    <h1>Locker Details</h1>

    <p>
        <strong>ID:</strong>
        {{ $locker->id }}
    </p>

    <p>
        <strong>Name:</strong>
        {{ $locker->name }}
    </p>

    <p>
        <strong>Status:</strong>
        {{ $locker->status }}
    </p>

    <p>
        <strong>Location:</strong>
        {{ $locker->location->name ?? 'No Location' }}
    </p>

    <br>

    <a href="{{ route('lockers.edit', $locker->id) }}">
        Edit
    </a>

    |

    <a href="{{ route('lockers.index') }}">
        Back
    </a>

</div>

</body>
</html>