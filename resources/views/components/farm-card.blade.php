@props(['farm'])

<div class="flex flex-col bg-white dark:bg-gray-800 rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 p-5">
    <h3 class="font-semibold text-lg text-gray-800 dark:text-white mb-1">{{ $farm->name }}</h3>
    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">{{ $farm->location ?? '—' }}</p>
    <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">🌾 {{ $farm->plants_count ?? ($farm->plants ? $farm->plants->count() : 0) }} plants</p>
    <a href="{{ Route::has('public.farms.show') ? route('public.farms.show', $farm->slug) : url('/farms/' . $farm->slug) }}" class="mt-auto text-sm font-medium text-green-600 dark:text-green-400 hover:underline" aria-label="View {{ $farm->name }}">View →</a>
</div>
