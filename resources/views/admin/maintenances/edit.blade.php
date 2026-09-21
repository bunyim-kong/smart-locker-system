<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Maintenance</title>
</head>
<body>
    <h1>Edit Maintenance</h1>

    <form action="{{ route('maintenances.update', $maintenance->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="locker_id">Locker</label><br>
            <select name="locker_id" id="locker_id" required>
                <option value="">-- Select locker --</option>
                @foreach ($lockers as $locker)
                    <option value="{{ $locker->id }}" {{ old('locker_id', $maintenance->locker_id) == $locker->id ? 'selected' : '' }}>
                        {{ $locker->locker_code ?? 'Locker #' . $locker->id }}
                    </option>
                @endforeach
            </select>
            @error('locker_id')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="issue_des">Issue Description</label><br>
            <textarea name="issue_des" id="issue_des" rows="4" maxlength="1000" required>{{ old('issue_des', $maintenance->issue_des) }}</textarea>
            @error('issue_des')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="report_date">Report Date</label><br>
            <input type="date" name="report_date" id="report_date"
                   value="{{ old('report_date', $maintenance->report_date ? \Carbon\Carbon::parse($maintenance->report_date)->format('Y-m-d') : '') }}" required>
            @error('report_date')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="resolve_date">Resolve Date</label><br>
            <input type="date" name="resolve_date" id="resolve_date"
                   value="{{ old('resolve_date', $maintenance->resolve_date ? \Carbon\Carbon::parse($maintenance->resolve_date)->format('Y-m-d') : '') }}" required>
            @error('resolve_date')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Update</button>
        <a href="{{ route('maintenances.index') }}">Cancel</a>
    </form>
</body>
</html>