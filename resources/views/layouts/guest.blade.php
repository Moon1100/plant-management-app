<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="themeManager()"
      x-init="initTheme()"
      x-bind:class="{ 'dark': $root.darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 transition-colors duration-500">
    <!-- Minimal topbar -->
    <div class="w-full border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 py-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-end">
            @include('components.theme-toggle')
        </div>
    </div>

    <!-- Page content -->
    <div class="min-h-screen flex flex-col justify-center items-center px-4">
        <div class="w-full sm:max-w-md mt-6 px-6 py-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-lg rounded-2xl">
            {{ $slot }}
        </div>
    </div>

    @livewireScripts

    <!-- Theme Manager -->
    <script>
        function themeManager() {
            return {
                darkMode: false,
                initTheme() {
                    try {
                        const stored = localStorage.getItem('theme');
                        if (stored === 'dark') this.darkMode = true;
                        else if (stored === 'light') this.darkMode = false;
                        else this.darkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
                        this.apply();
                    } catch (e) { console.error(e); }
                },
                toggleTheme() {
                    this.darkMode = !this.darkMode;
                    try { localStorage.setItem('theme', this.darkMode ? 'dark' : 'light'); } catch (e) {}
                    this.apply();
                },
                apply() {
                    document.documentElement.classList.toggle('dark', this.darkMode);
                }
            }
        }
    </script>
</body>
</html>
