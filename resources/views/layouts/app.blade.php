{{-- filepath: /Users/bayam/Documents/web/plant-management/plant-managemet/resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
<script src="//unpkg.com/alpinejs" defer></script>


    <title>{{ config('app.name', 'Plant Management') }}</title>

    <icon rel="icon" href="{{ asset("favicon.ico") }}" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire -->
    @livewireStyles
</head>

<body class="font-sans antialiased bg-gray-900 text-gray-100 transition-colors duration-500" x-data="{ showMobileMenu: false }">
    <!-- Navigation -->
    <nav
        class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 sticky top-0 z-50 transition-all duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo & Main Nav -->
                <div class="flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <span class="text-2xl">🌱</span>
                        <span class="ml-2 text-xl font-semibold text-gray-900 dark:text-gray-100">PlantTracker</span>
                    </a>

                    <div class="hidden md:flex space-x-6">
                        <a href="{{ route('home') }}"
                            class="text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 font-medium">Dashboard</a>
                        {{-- <a href="{{ Route::has('public.farms') ? route('public.farms') : url('/farms') }}" class="text-gray-500 dark:text-gray-400 hover:text-green-600 dark:hover:text-green-400 font-medium">Ladang</a> --}}
                    </div>
                </div>

                <!-- Right side -->
                <div class="flex items-center space-x-4">
                    {{-- 🌙 Theme Toggle --}}
                    {{-- <button @click="$root.toggleTheme()"
                        class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-300"
                        x-tooltip="Toggle dark mode">
                        <template x-if="!$root.darkMode">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 3v1m0 16v1m8.66-9H21m-18 0h1m1.34-6.66l.71.71M16.95 16.95l.71.71m0-12.72l-.71.71M6.34 17.66l-.71.71M12 5a7 7 0 0 1 0 14 7 7 0 0 1 0-14z" />
                            </svg>
                        </template>
                        <template x-if="$root.darkMode">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd" d="M10 2a8 8 0 1 0 8 8c0-.34-.02-.67-.05-1A7 7 0 0 1 10 2z"
                                    clip-rule="evenodd" />
                            </svg>
                        </template>
                    </button> --}}

                    @auth
                        <div class="hidden md:flex space-x-4">
                            <a href="{{ Route::has('farms.index') ? route('farms.index') : url('/farms') }}"
                                class="text-gray-500 dark:text-gray-400 hover:text-green-600 dark:hover:text-green-400 font-medium">
                                My Farms
                            </a>
                            <a href="{{ route('plants.index') }}"
                                class="text-gray-500 dark:text-gray-400 hover:text-green-600 dark:hover:text-green-400 font-medium">
                                My Plants
                            </a>
                        </div>

                        <!-- User dropdown -->
                        <div class="relative hidden sm:block" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-green-500">
                                <img class="h-8 w-8 rounded-full"
                                    src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                                    alt="{{ auth()->user()->name }}">
                                <span
                                    class="ml-2 text-gray-700 dark:text-gray-200 hidden md:block">{{ auth()->user()->name }}</span>
                            </button>

                            <div x-show="open" @click.away="open = false" x-transition
                                class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md shadow-lg py-1 z-50">
                                {{-- <a href="{{ route('farms.create') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Cipta
                                    Ladang Baru</a> --}}
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Log
                                        Keluar</button>
                                </form>
                            </div>
                        </div>
                        @else
                        <!-- Google Sign-In -->
                        {{-- <div id="g_id_onload" data-client_id="{{ config('services.google.client_id') }}"
                            data-login_uri="{{ Route::has('auth.google.callback') ? route('auth.google.callback') : url('/auth/google/callback') }}"
                            data-auto_prompt="false"></div>

                        <div class="g_id_signin" data-type="standard" data-size="medium" data-theme="outline"
                            data-text="sign_in_with" data-shape="rectangular" data-logo_alignment="left"></div> --}}

                        <a href="{{ route('login') }}"
                            class="text-gray-500 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 font-medium hidden sm:block">
                            Log In
                        </a>

                        <a href="{{ route('register') }}"
                            class="text-gray-500 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 font-medium hidden sm:block">
                            Sign Up
                        </a>
                    @endauth

                    <!-- Mobile Menu Button -->
                    <button @click="showMobileMenu = !showMobileMenu"
                        class="md:hidden p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div x-show="showMobileMenu" x-transition
            class="md:hidden bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
            <div class="px-4 py-3 space-y-2">
                <a href="{{ route('home') }}"
                    class="block text-base text-gray-900 dark:text-gray-100 hover:text-green-600 dark:hover:text-green-400">Dashboard</a>
                <a href="{{ Route::has('public.farms') ? route('public.farms') : url('/farms') }}"
                    class="block text-base text-gray-600 dark:text-gray-400 hover:text-green-600 dark:hover:text-green-400">Community
                    Farms</a>




                @auth
                    <a href="{{ route('farms.index') }}"
                        class="block px-4 py-2 text-base text-gray-700 dark:text-gray-200 hover:text-green-600 dark:hover:text-green-400">
                        My Farms
                    </a>

                    <a href="{{ route('plants.index') }}"
                        class="block px-4 py-2 text-base text-gray-700 dark:text-gray-200 hover:text-green-600 dark:hover:text-green-400">
                        My Plants
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 text-base text-gray-700 dark:text-gray-200 hover:text-green-600 dark:hover:text-green-400">
                            Log Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="block px-4 py-2 text-base text-gray-700 dark:text-gray-200 hover:text-green-600 dark:hover:text-green-400">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                        class="block px-4 py-2 text-base text-gray-700 dark:text-gray-200 hover:text-green-600 dark:hover:text-green-400">
                        Register
                    </a>
                @endauth

            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
@if (session('success'))
    <div class="flex justify-center mt-4">
        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition
            class="relative max-w-4xl w-full bg-green-50 dark:bg-green-900 border border-green-200 dark:border-green-800
                   text-green-800 dark:text-green-100 px-4 py-3 rounded shadow-md"
        >
            <span class="block text-center sm:inline">{{ session('success') }}</span>

            <button
                @click="show = false"
                class="absolute top-0 bottom-0 right-0 px-4 py-3 focus:outline-none"
            >
                <svg
                    class="fill-current h-6 w-6 text-green-500"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </button>
        </div>
    </div>
@endif


    <!-- Page Content -->
    <main class="transition-colors duration-500">
        @isset($slot)
            {{ $slot }}
        @else
            @yield('content')
        @endisset
    </main>

    <!-- Footer -->
    {{-- <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 mt-12 transition-all duration-500">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-500 dark:text-gray-400 text-sm">© {{ date('Y') }} PlantTracker. Sistem pengurusan pokok untuk semua.</p>
        </div>
    </footer> --}}


    <!-- Google Sign-In Script -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>

    <!-- Dark theme enforced globally -->

    @livewireScripts
    @livewire('wire-elements-modal')

    @stack('scripts')
    <script>
        window.addEventListener('plants:changed', function(e) {
            // simple approach: reload page to refresh listings
            location.reload();
        });
    </script>
</body>

</html>
