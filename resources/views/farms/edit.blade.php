@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h1 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Edit Farm</h1>

        <form method="POST" action="{{ route('farms.update', $farm) }}">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-200">Name</label>
                    <input name="name" value="{{ $farm->name }}" class="w-full mt-1 px-3 py-2 border rounded" />
                </div>

                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-200">Location</label>
                    <input name="location" value="{{ $farm->location }}" class="w-full mt-1 px-3 py-2 border rounded" />
                </div>

                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-200">Description</label>
                    <textarea name="description" class="w-full mt-1 px-3 py-2 border rounded">{{ $farm->description }}</textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
