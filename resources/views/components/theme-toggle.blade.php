@props([])

<button @click="$root.toggleTheme()"
        class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-300"
        x-tooltip="Toggle dark mode"
        aria-label="Toggle theme">
    <template x-if="!$root.darkMode">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8.66-9H21m-18 0h1m1.34-6.66l.71.71M16.95 16.95l.71.71m0-12.72l-.71.71M6.34 17.66l-.71.71M12 5a7 7 0 0 1 0 14 7 7 0 0 1 0-14z"/>
        </svg>
    </template>
    <template x-if="$root.darkMode">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 2a8 8 0 1 0 8 8c0-.34-.02-.67-.05-1A7 7 0 0 1 10 2z" clip-rule="evenodd" />
        </svg>
    </template>
</button>
