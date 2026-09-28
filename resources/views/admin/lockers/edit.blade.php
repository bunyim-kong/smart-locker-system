@extends('layouts.admin')

@section('title', 'Edit Locker')

@section('content')
<div class="p-6 w-full">
    <div class="flex items-center gap-2 mb-6">
        <a href="{{ route('admin.lockers.index') }}" class="text-gray-400 hover:text-gray-600">
            <span aria-hidden="true">&larr;</span><span class="sr-only">Back to lockers</span>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Edit Locker {{ $locker->name }}</h1>
    </div>

    <form action="{{ route('admin.lockers.update', $locker) }}" method="POST"
          class="bg-white border border-gray-100 rounded-xl p-8 w-full">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Locker Name</label>
                <input type="text" name="name" id="name" required value="{{ old('name', $locker->name) }}"
                       class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-400 @enderror">
                @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="location_id" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                <select name="location_id" id="location_id" required
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('location_id') border-red-400 @enderror">
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}" @selected(old('location_id', $locker->location_id) == $location->id)>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
                @error('location_id') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status" required
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status') border-red-400 @enderror">
                    @foreach (['Available', 'In Use', 'Maintenance'] as $status)
                        <option value="{{ $status }}" @selected(old('status', $locker->status) == $status)>{{ $status }}</option>
                    @endforeach
                </select>
                @error('status') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-8">
            <a href="{{ route('admin.lockers.index') }}"
               class="px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700">
                Save changes
            </button>
        </div>
    </form>
</div>
@endsection
