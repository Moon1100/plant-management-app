@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $farm->name }}</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $farm->description }}</p>

        <div class="mt-6">
            <a href="{{ route('plants.create', ['farm' => $farm]) }}" class="px-4 py-2 bg-green-600 text-white rounded">Add Plant</a>
        </div>
    </div>
</div>
@endsection
