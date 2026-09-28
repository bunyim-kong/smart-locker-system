@extends('layouts.admin')

@section('title', 'Add Maintenance')

@section('content')
<div class="w-full p-4 sm:p-6">
    <div class="mb-6 flex items-center gap-2">
        <a href="{{ route('admin.maintenances.index') }}" class="text-gray-400 hover:text-gray-600"><span aria-hidden="true">&larr;</span><span class="sr-only">Back to maintenance</span></a>
        <h1 class="text-2xl font-bold text-gray-900">Add Maintenance</h1>
    </div>
    <form action="{{ route('admin.maintenances.store') }}" method="POST" class="w-full rounded-xl border border-gray-100 bg-white p-5 sm:p-8">
        @csrf
        @include('admin.maintenances._form')
        <div class="flex justify-end gap-3 pt-8">
            <a href="{{ route('admin.maintenances.index') }}" class="rounded-lg border border-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
            <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Add maintenance</button>
        </div>
    </form>
</div>
@endsection
