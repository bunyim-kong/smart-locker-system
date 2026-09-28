<p class="mb-6 text-sm text-gray-500">Track the issue here. Manage locker availability separately on the <a href="{{ route('admin.lockers.index') }}" class="text-blue-600 underline">Lockers page</a>.</p>
<div class="grid grid-cols-1 gap-6 md:grid-cols-2">
    <div class="md:col-span-2">
        <label for="locker_id" class="mb-1 block text-sm font-medium text-gray-700">Locker</label>
        <select name="locker_id" id="locker_id" required class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('locker_id') border-red-400 @enderror">
            <option value="">Select locker</option>
            @foreach ($lockers as $locker)
                <option value="{{ $locker->id }}" @selected(old('locker_id', $maintenance->locker_id ?? '') == $locker->id)>{{ $locker->name }} · {{ $locker->location->name }}</option>
            @endforeach
        </select>
        @error('locker_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        @if ($lockers->isEmpty())
            <p class="mt-2 text-sm text-gray-500">No lockers yet. <a href="{{ route('admin.lockers.create') }}" class="text-blue-600 underline">Add a locker</a> first.</p>
        @endif
    </div>
    <div class="md:col-span-2">
        <label for="issue_des" class="mb-1 block text-sm font-medium text-gray-700">Issue description</label>
        <textarea name="issue_des" id="issue_des" rows="4" maxlength="255" required placeholder="Describe the issue..." class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('issue_des') border-red-400 @enderror">{{ old('issue_des', $maintenance->issue_des ?? '') }}</textarea>
        @error('issue_des') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="report_date" class="mb-1 block text-sm font-medium text-gray-700">Report date</label>
        <input type="date" name="report_date" id="report_date" required max="{{ today()->toDateString() }}" value="{{ old('report_date', isset($maintenance) ? $maintenance->report_date->toDateString() : today()->toDateString()) }}" class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('report_date') border-red-400 @enderror">
        @error('report_date') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="resolve_date" class="mb-1 block text-sm font-medium text-gray-700">Resolution date</label>
        <input type="date" name="resolve_date" id="resolve_date" required max="{{ today()->toDateString() }}" value="{{ old('resolve_date', isset($maintenance) ? $maintenance->resolve_date?->toDateString() : '') }}" class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('resolve_date') border-red-400 @enderror">
        @error('resolve_date') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
    </div>
</div>
