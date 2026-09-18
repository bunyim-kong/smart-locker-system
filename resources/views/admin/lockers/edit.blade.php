<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Locker</title>
</head>

<body>

<div style="max-width: 600px; margin: 40px auto;">

    <h1>Edit Locker</h1>

    @if ($errors->any())

        <div style="color: red;">

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif

    <form
        action="{{ route('lockers.update', $locker->id) }}"
        method="POST"
    >

        @csrf

        @method('PUT')

        <div style="margin-bottom: 15px;">

            <label>Locker Name</label>

            <br>

            <input
                type="text"
                name="name"
                value="{{ old('name', $locker->name) }}"
                required
            >

        </div>

        <div style="margin-bottom: 15px;">

            <label>Status</label>

            <br>

             <select
                name="status"
                id="status"
                required
            >

                <option value="">
                     Select Status 
                </option>

                <option value="Available">
                    Available
                </option>

                <option value="In Use">
                    In-Used
                </option>

                <option value="Maintenance">
                    Maintenance
                </option>

            </select>

        </div>

        <div style="margin-bottom: 15px;">

            <label>Location</label>

            <br>

            <select name="location_id" required>

                @foreach($locations as $location)

                    <option
                        value="{{ $location->id }}"
                        {{ $locker->location_id == $location->id ? 'selected' : '' }}
                    >
                        {{ $location->name }}
                    </option>

                @endforeach

            </select>

        </div>

        <button type="submit">
            Update Locker
        </button>

        <a href="{{ route('lockers.index') }}">
            Cancel
        </a>

    </form>

</div>

</body>
</html>