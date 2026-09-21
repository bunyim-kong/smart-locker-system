@extends('layouts.app')

@section('content')

<div style="max-width: 700px; margin: 40px auto; padding: 0 20px;">

    <h1>Edit Location</h1>

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('locations.update', $location) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Name:</label><br>
            <input type="text" name="name" value="{{ old('name', $location->name) }}">
        </div>
        <div>
            <label>Address:</label><br>
            <input type="text" name="address" value="{{ old('address', $location->address) }}">
        </div>
        <div>
            <label>Map Link:</label><br>
            <input type="text" name="map_link" value="{{ old('map_link', $location->map_link) }}">
        </div>
        <button type="submit">Update Location</button>
    </form>

    <p><a href="{{ route('locations.index') }}">← Back to list</a></p>

</div>

@endsection