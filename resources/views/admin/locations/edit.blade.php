<form action="{{ route('locations.update', $location) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name', $location->name) }}">
        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="address">Address</label>
        <input type="text" name="address" id="address" value="{{ old('address', $location->address) }}">
        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="map_link">Map Link</label>
        <input type="text" name="map_link" id="map_link" value="{{ old('map_link', $location->map_link) }}">
        @error('map_link') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <button type="submit">Update Location</button>
</form>