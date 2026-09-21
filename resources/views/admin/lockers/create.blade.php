```html
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Add Locker</title>
</head>

<body>

<div style="max-width: 600px; margin: 40px auto;">

    <h1>Add New Locker</h1>


    {{-- Validation errors --}}

    @if ($errors->any())

        <div style="color: red;">

            <ul>

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('lockers.store') }}"
        method="POST"
    >

        @csrf


        {{-- Locker Name --}}

        <div style="margin-bottom: 15px;">

            <label for="name">
                Locker Name
            </label>

            <br>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                required
            >

        </div>


        {{-- Status --}}

        <div style="margin-bottom: 15px;">

            <label for="status">
                Status
            </label>

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


        {{-- Location --}}

        <div style="margin-bottom: 15px;">

            <label for="location_id">
                Location
            </label>
            <br>
            <select name="location_id" id="location_id">
                <option value="">-- Select a location --</option>
                @foreach ($locations as $location)
                    <option value="{{ $location->id }}"
                        {{ old('location_id', $locker->location_id ?? '') == $location->id ? 'selected' : '' }}>
                        {{ $location->name }}
                    </option>
                @endforeach
            </select>
            @error('location_id')
                <span style="color: red;">{{ $message }}</span>
            @enderror

        </div>


        {{-- Buttons --}}

        <button type="submit">
            Save Locker
        </button>

        <a href="{{ route('lockers.index') }}">
            Cancel
        </a>

    </form>

</div>

</body>

</html>

