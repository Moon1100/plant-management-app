<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 dark:bg-gray-900 text-gray-100">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-6 dark:bg-gray-800 shadow-lg overflow-hidden sm:rounded-lg border border-gray-700">
        {{ $slot }}
    </div>
</div>
