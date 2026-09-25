@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-2xl mx-auto">
    <div class="flex items-center gap-2 mb-6">
        <a href="{{ route('maintenances.index') }}" class="text-gray-400 hover:text-gray-600">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Create Maintenance</h1>
    </div>

    <form action="{{ route('maintenances.store') }}" method="POST"
          class="bg-white border border-gray-100 rounded-xl p-6 space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Locker</label>
            <select name="locker_id" required
                    class="w-full px-3 py-2 border {{ $errors->has('locker_id') ? 'border-red-400' : 'border-gray-200' }} rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Select locker --</option>
                @foreach ($lockers as $locker)
                    <option value="{{ $locker->id }}" @selected(old('locker_id') == $locker->id)>
                        {{ $locker->locker_code ?? 'Locker #' . $locker->id }}
                    </option>
                @endforeach
            </select>
            @error('locker_id') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Issue Description</label>
            <textarea name="issue_des" rows="4" maxlength="1000" required
                      placeholder="Describe the issue..."
                      class="w-full px-3 py-2 border {{ $errors->has('issue_des') ? 'border-red-400' : 'border-gray-200' }} rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('issue_des') }}</textarea>
            @error('issue_des') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Report Date</label>
                <input type="date" name="report_date" value="{{ old('report_date') }}" required
                       class="w-full px-3 py-2 border {{ $errors->has('report_date') ? 'border-red-400' : 'border-gray-200' }} rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('report_date') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Resolve Date</label>
                <input type="date" name="resolve_date" value="{{ old('resolve_date') }}" required
                       class="w-full px-3 py-2 border {{ $errors->has('resolve_date') ? 'border-red-400' : 'border-gray-200' }} rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('resolve_date') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-2">
            <a href="{{ route('maintenances.index') }}"
               class="px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700">
                Save
            </button>
        </div>
    </form>
</div>
@endsection