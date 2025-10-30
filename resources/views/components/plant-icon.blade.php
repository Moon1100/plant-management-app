@if ($isImage)
    <img src="{{ asset('plant_type_icon/' . $icon) }}"
         alt="icon"
         class="inline w-1/2 h-1/2">
@else
    <span class="text-7xl">{{ $icon }}</span>
@endif
