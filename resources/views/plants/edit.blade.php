@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <livewire:plant-edit-form :plant="$plant" />
    </div>
@endsection
