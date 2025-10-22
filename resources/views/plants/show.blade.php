@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-semibold mb-4">{{ $plant->name }}</h1>

        <div class="bg-white p-6 rounded shadow">
            <p class="text-sm text-gray-600">Farm: {{ $plant->farm->name ?? '—' }}</p>
            <p class="mt-4">{{ $plant->notes }}</p>

            @if($plant->qr_code_path)
                <div class="mt-4">
                    <img src="{{ Storage::url($plant->qr_code_path) }}" alt="QR code">
                </div>
            @endif
        </div>
    </div>
@endsection
