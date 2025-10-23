{{-- resources/views/farms/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Community Farm</h1>
            <a href="{{ route('farms.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700" aria-label="Create new farm">Add New Farm</a>
        </div>

                @if($farms->count())
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($farms as $farm)
                    @include('components.farm-card', ['farm' => $farm])
                @endforeach
            </div>

            <div class="mt-6">
                {{ $farms->links() }}
            </div>
        @else
            <p class="text-gray-500">No farms yet.</p>
        @endif
    </div>
</div>
@endsection
