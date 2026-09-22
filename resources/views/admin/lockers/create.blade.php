@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-2xl mx-auto">
    <div class="flex items-center gap-2 mb-6">
        <a href="{{ route('lockers.index') }}" class="text-gray-400 hover:text-gray-600">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Add Locker</h1>
    </div>

    <form action="{{ route('lockers.store') }}" method="POST"
          class="bg-white border border-gray-100 rounded-xl p-6 space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Locker Name</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. L-016"
                   class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-400 @enderror">
            @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Size</label>
            <select name="size"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('size') border-red-400 @enderror">
                <option value="">Select size</option>
                @foreach (['Small', 'Medium', 'Large'] as $size)
                    <option value="{{ $size }}" @selected(old('size') == $size)>{{ $size }}</option>
                @endforeach
            </select>
            @error('size') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
            <select name="location_id"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('location_id') border-red-400 @enderror">
                <option value="">Select location</option>
                @foreach ($locations as $location)
                    <option value="{{ $location->id }}" @selected(old('location_id') == $location->id)>
                        {{ $location->name }}
                    </option>
                @endforeach
            </select>
            @error('location_id') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status') border-red-400 @enderror">
                @foreach (['Available', 'In Use', 'Maintenance'] as $status)
                    <option value="{{ $status }}" @selected(old('status') == $status)>{{ $status }}</option>
                @endforeach
            </select>
            @error('status') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end gap-3 pt-2">
            <a href="{{ route('lockers.index') }}"
               class="px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700">
                Add locker
            </button>
        </div>
    </form>
</div>
@endsection