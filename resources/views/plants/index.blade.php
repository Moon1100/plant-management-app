{{-- resources/views/plants/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Pokok Saya</h1>
        <div class="flex items-center space-x-2">
            <a href="{{ route('farms.index') }}" class="px-3 py-2 border rounded">My Farms</a>
            <a href="{{ route('plants.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Tambah Pokok</a>
        </div>
    </div>

    @if($plants->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($plants as $plant)
                @include('components.plant-card', ['plant' => $plant])
            @endforeach
        </div>

        <div class="mt-6">
            {{ $plants->links() }}
        </div>
    @else
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg">
            <p class="text-gray-600 dark:text-gray-300">You don't have any plants yet. Create one to get started.</p>
        </div>
    @endif
</div>
@endsection
