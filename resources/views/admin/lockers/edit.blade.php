@extends('layouts.admin')

@section('title', 'Locker')

@section('content')
<section class="w-full">
    <div class="mb-6 flex items-center gap-2">
        <h1 class="text-2xl font-bold text-gray-900">Edit Locker {{ $locker->name }}</h1>
    </div>

    <form action="{{ route('admin.lockers.update', $locker) }}" method="POST" class="w-full rounded-xl border border-gray-100 bg-white p-8">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <label for="name" class="mb-1 block text-sm font-medium text-gray-700">Locker Name</label>
                <input type="text" name="name" id="name" required value="{{ old('name', $locker->name) }}" placeholder="e.g. L-016"
                       class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-400 @enderror">
                @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="location_id" class="mb-1 block text-sm font-medium text-gray-700">Location</label>
                <select name="location_id" id="location_id" required class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('location_id') border-red-400 @enderror">
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}" @selected(old('location_id', $locker->location_id) == $location->id)>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
                @error('location_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="status" class="mb-1 block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" required class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status') border-red-400 @enderror">
                    @foreach (['Available', 'In Use', 'Maintenance'] as $status)
                        <option value="{{ $status }}" @selected(old('status', $locker->status) == $status)>{{ $status }}</option>
                    @endforeach
                </select>
                @error('status') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-8">
            <a href="{{ route('admin.lockers.index') }}" class="rounded-lg border border-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                Save changes
            </button>
        </div>
    </form>
</section>
@endsection
