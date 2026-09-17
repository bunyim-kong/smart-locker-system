@extends('layouts.app')

@section('content')

<div style="max-width: 700px; margin: 40px auto; padding: 0 20px;">

    <h1>Locations — Test Page</h1>

    {{-- Success message --}}
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    {{-- Validation errors --}}
    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <hr>

    {{-- CREATE FORM --}}
    <h2>Add New Location</h2>
    <form action="{{ route('locations.store') }}" method="POST">
        @csrf
        <div>
            <label>Name:</label><br>
            <input type="text" name="name" value="{{ old('name') }}">
        </div>
        <div>
            <label>Address:</label><br>
            <input type="text" name="address" value="{{ old('address') }}">
        </div>
        <div>
            <label>Map Link:</label><br>
            <input type="text" name="map_link" value="{{ old('map_link') }}">
        </div>
        <button type="submit">Create Location</button>
    </form>

    <hr>

    {{-- LIST --}}
    <h2>All Locations</h2>
    <table border="1" cellpadding="8" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Map Link</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($locations as $location)
                <tr>
                    <td>{{ $location->id }}</td>
                    <td>{{ $location->name }}</td>
                    <td>{{ $location->address }}</td>
                    <td>{{ $location->map_link }}</td>
                    <td>
                        <a href="{{ route('locations.show', $location) }}">View</a> |
                        <a href="{{ route('locations.edit', $location) }}">Edit</a> |
                        <form action="{{ route('locations.destroy', $location) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this location?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No locations yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection