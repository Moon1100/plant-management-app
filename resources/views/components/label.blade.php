@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-200 dark:text-gray-200 text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
