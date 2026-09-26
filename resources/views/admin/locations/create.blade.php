{{-- Use the layout that has your sidebar --}}
@extends('layouts.admin')

@section('content')

<div class="w-full p-6 border border-gray-200 rounded-xl bg-white">
    <form action="{{ route('locations.store') }}" method="POST">
        @csrf

        {{-- Name --}}
        <div class="mb-[18px]">
            <label for="name" class="block mb-1.5 text-sm font-semibold text-gray-900">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                   placeholder="Central Library"
                   class="w-full h-10 px-3 border rounded-lg text-sm focus:outline focus:outline-2 focus:outline-[#0a8cf5] focus:border-transparent @error('name') border-[#b42318] @else border-gray-200 @enderror">
            @error('name') <div class="mt-1.5 text-[13px] text-[#b42318]">{{ $message }}</div> @enderror
        </div>

        {{-- Address --}}
        <div class="mb-[18px]">
            <label for="address" class="block mb-1.5 text-sm font-semibold text-gray-900">Address</label>
            <input type="text" name="address" id="address" value="{{ old('address') }}"
                   placeholder="123 Main St, Springfield"
                   class="w-full h-10 px-3 border rounded-lg text-sm focus:outline focus:outline-2 focus:outline-[#0a8cf5] focus:border-transparent @error('address') border-[#b42318] @else border-gray-200 @enderror">
            @error('address') <div class="mt-1.5 text-[13px] text-[#b42318]">{{ $message }}</div> @enderror
        </div>

        {{-- Map link --}}
        <div class="mb-[18px]">
            <label for="map_link" class="block mb-1.5 text-sm font-semibold text-gray-900">Map link</label>
            <input type="text" name="map_link" id="map_link" value="{{ old('map_link') }}"
                   placeholder="https://www.google.com/maps/..."
                   class="w-full h-10 px-3 border rounded-lg text-sm focus:outline focus:outline-2 focus:outline-[#0a8cf5] focus:border-transparent @error('map_link') border-[#b42318] @else border-gray-200 @enderror">
            @error('map_link') <div class="mt-1.5 text-[13px] text-[#b42318]">{{ $message }}</div> @enderror
        </div>

        {{-- Buttons --}}
        <div class="flex gap-3 mt-6">
            <button type="submit"
                    class="inline-flex items-center h-10 px-[18px] border border-[#0a8cf5] rounded-lg bg-[#0a8cf5] text-white text-sm font-medium cursor-pointer">
                Save location
            </button>
            <a href="{{ route('locations.index') }}"
               class="inline-flex items-center h-10 px-[18px] border border-gray-200 rounded-lg bg-white text-gray-900 text-sm font-medium no-underline cursor-pointer">
                Cancel
            </a>
        </div>
    </form>
</div>

@endsection