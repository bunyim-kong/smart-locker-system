<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Detail</title>
</head>
<body>
    
    <h1>Maintenance Detail</h1>

    <p> <strong>ID :</strong>{{ $maintenance->id }}</p>

    <p><strong>Locker ID :</strong>{{ $maintenance->locker_id }}</p>
    <p><strong>User ID :</strong>{{ $maintenance->user_id }}</p>
    <p><strong>Reported By :</strong>{{ $maintenance->user->name ?? '-' }}</p>
    <p><strong>Issue_des :</strong>{{ $maintenance->issue_des }}</p>
    <p><strong>Report Date :</strong>{{ $maintenance->report_date }}</p>
    <p><strong>Resolve Date :</strong>{{ $maintenance->resolve_date }}</p>

    <a href="{{ route('maintenance.edit', $maintenance) }}">Edit</a>
    <a href="{{ route('maintenance.index') }}">Back</a>

</body>
</html>