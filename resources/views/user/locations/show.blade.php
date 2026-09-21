@extends('layouts.app')

@section('content')

<div style="max-width: 700px; margin: 40px auto; padding: 0 20px;">

    <h1>{{ $location->name }}</h1>
    <p><strong>Address:</strong> {{ $location->address }}</p>
    <p><strong>Map Link:</strong> <a href="{{ $location->map_link }}" target="_blank">{{ $location->map_link }}</a></p>

    <p><a href="{{ route('locations.index') }}">← Back to list</a></p>

</div>

@endsection