@extends('layouts.admin')

@section('title', 'Location')

@section('content')
<section class="w-full">
    <div class="flex items-center gap-2 mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Location {{ $location->name }}</h1>
    </div>

    <form action="{{ route('admin.locations.update', $location) }}" method="POST"
          class="bg-white border border-gray-100 rounded-xl p-8 w-full">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Location Name</label>
                <input type="text" name="name" id="name" required value="{{ old('name', $location->name) }}"
                       placeholder="Central Library"
                       class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-400 @enderror">
                @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                <input type="text" name="address" id="address" required value="{{ old('address', $location->address) }}"
                       placeholder="123 Main St, Springfield"
                       class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('address') border-red-400 @enderror">
                @error('address') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2">
                <label for="map_link" class="block text-sm font-medium text-gray-700 mb-1">Map link</label>
                <input type="text" name="map_link" id="map_link" value="{{ old('map_link', $location->map_link) }}"
                       placeholder="https://www.google.com/maps/..."
                       class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('map_link') border-red-400 @enderror">
                @error('map_link') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-8">
            <a href="{{ route('admin.locations.index') }}"
               class="px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700">
                Save changes
            </button>
        </div>
    </form>
</section>
@endsection