@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        @php
            // If a farm query param is present (e.g. ?farm=3) we'll preselect it via Livewire props
            $selectedFarm = request()->query('farm');
        @endphp

        <livewire:plant-create-form :wire:key="'plant-create-'.($selectedFarm ?? 'default')" />
    </div>
@endsection
