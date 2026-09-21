@extends('layouts.admin')

@section('content')

<style>
    .locker-title {
        margin: 0 0 24px;
        font-size: 26px;
        font-weight: 700;
        color: #1f2937;
    }

    .locker-card {
        max-width: 520px;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 28px;
    }

    .locker-form {
        margin: 0;
    }

    .form-field {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 6px;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
    }

    .form-input {
        width: 100%;
        box-sizing: border-box;
        padding: 10px 12px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 14px;
        background: #ffffff;
        color: #111827;
    }

    .form-error {
        margin: 6px 0 0;
        font-size: 13px;
        color: #dc2626;
    }

    .button-group {
        display: flex;
        gap: 12px;
        margin-top: 8px;
    }

    .btn-update {
        padding: 10px 20px;
        background: #2563eb;
        color: #ffffff;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-cancel {
        padding: 10px 20px;
        background: #ffffff;
        color: #374151;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
    }
</style>

<h1 class="locker-title">
    Edit locker {{ $locker->name }}
</h1>

<div class="locker-card">

    <form
        action="{{ route('lockers.update', $locker) }}"
        method="POST"
        class="locker-form"
    >

        @csrf
        @method('PUT')

        {{-- Name --}}
        <div class="form-field">
            <label for="name" class="form-label">
                Locker ID
            </label>

            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name', $locker->name) }}"
                class="form-input"
            >

            @error('name')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Location --}}
        <div class="form-field">
            <label for="location_id" class="form-label">
                Location
            </label>

            <select
                id="location_id"
                name="location_id"
                class="form-input"
            >
                @foreach ($locations as $location)
                    <option
                        value="{{ $location->id }}"
                        @selected(old('location_id', $locker->location_id) == $location->id)
                    >
                        {{ $location->name }}
                    </option>
                @endforeach
            </select>

            @error('location_id')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Size --}}
        <div class="form-field">
            <label for="size" class="form-label">
                Size
            </label>

            <select
                id="size"
                name="size"
                class="form-input"
            >
                @foreach (['Small', 'Medium', 'Large'] as $size)
                    <option
                        value="{{ $size }}"
                        @selected(old('size', $locker->size) === $size)
                    >
                        {{ $size }}
                    </option>
                @endforeach
            </select>

            @error('size')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        <div class="form-field">
            <label for="status" class="form-label">
                Status
            </label>

            <select
                id="status"
                name="status"
                class="form-input"
            >
                @foreach (['Available', 'In Use', 'Maintenance'] as $status)
                    <option
                        value="{{ $status }}"
                        @selected(old('status', $locker->status) === $status)
                    >
                        {{ $status }}
                    </option>
                @endforeach
            </select>

            @error('status')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Buttons --}}
        <div class="button-group">

            <button type="submit" class="btn-update">
                Update Locker
            </button>

            <a
                href="{{ route('lockers.index') }}"
                class="btn-cancel"
            >
                Cancel
            </a>

        </div>

    </form>

</div>

@endsection
