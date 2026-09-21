@extends('layouts.admin')

@section('content')

<style>
    .page-title {
        font-size: 28px;
        font-weight: 700;
        margin: 0 0 24px;
        color: #091e42;
    }

    .form-card {
        max-width: 520px;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        padding: 28px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 6px;
        font-size: 14px;
        font-weight: 600;
        color: #334155;
    }

    .form-input {
        width: 100%;
        box-sizing: border-box;
        padding: 10px 12px;
        border: 1px solid #dfe1e6;
        border-radius: 8px;
        font-size: 14px;
        background: #ffffff;
        color: #0f172a;
    }

    .form-error {
        margin: 6px 0 0;
        font-size: 13px;
        color: #dc2626;
    }

    .form-buttons {
        display: flex;
        gap: 12px;
        margin-top: 8px;
    }

    .btn-primary {
        padding: 10px 20px;
        background: #2563eb;
        color: #ffffff;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
    }

    .btn-primary:hover {
        background: #1d4ed8;
    }

    .btn-secondary {
        padding: 10px 20px;
        background: #ffffff;
        color: #334155;
        border: 1px solid #dfe1e6;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
    }
</style>

<h1 class="page-title">Add locker</h1>

<div class="form-card">
    <form action="{{ route('lockers.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name" class="form-label">Locker ID</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="L-016" class="form-input">
            @error('name') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="location_id" class="form-label">Location</label>
            <select id="location_id" name="location_id" class="form-input">
                <option value="">Select a location</option>
                @foreach ($locations as $location)
                    <option value="{{ $location->id }}" @selected(old('location_id') == $location->id)>{{ $location->name }}</option>
                @endforeach
            </select>
            @error('location_id') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="size" class="form-label">Size</label>
            <select id="size" name="size" class="form-input">
                @foreach (['Small', 'Medium', 'Large'] as $size)
                    <option value="{{ $size }}" @selected(old('size') === $size)>{{ $size }}</option>
                @endforeach
            </select>
            @error('size') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-input">
                @foreach (['Available', 'In Use', 'Maintenance'] as $status)
                    <option value="{{ $status }}" @selected(old('status') === $status)>{{ $status }}</option>
                @endforeach
            </select>
            @error('status') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn-primary">Save locker</button>
            <a href="{{ route('lockers.index') }}" class="btn-secondary">Cancel</a>
        </div>
    </form>
</div>

@endsection