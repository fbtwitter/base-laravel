<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'My Laravel App') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400..600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body
    class="min-h-screen bg-white dark:bg-zinc-800 flex flex-col justify-center items-center"
    x-data="{
        sidebarOpen: false,
        darkMode: localStorage.getItem('darkMode') === 'true' ||
                  (!localStorage.getItem('darkMode') &&
                   window.matchMedia('(prefers-color-scheme: dark)').matches)
    }"
    x-init="
        if (darkMode) {
            document.documentElement.classList.add('dark')
        }
    "
    @keydown.escape="sidebarOpen = false"
>
<main class="w-full">
    {{ $slot }}
</main>

<!-- Dark mode toggle -->
<div class="fixed right-4 bottom-4 z-40">
    <button
        type="button"
        @click="
                darkMode = !darkMode;
                if (darkMode) {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('darkMode', 'true');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('darkMode', 'false');
                }
            "
        class="inline-flex items-center gap-x-2 rounded-full border border-gray-200 bg-white px-3 py-2 text-sm text-gray-800 shadow-lg transition-colors duration-200 hover:bg-gray-50 dark:border-gray-700 dark:bg-slate-900 dark:text-white dark:hover:bg-slate-800"
        :aria-label="darkMode ? 'Switch to light mode' : 'Switch to dark mode'"
    >
        <!-- Moon icon (dark mode) -->
        <svg
            x-show="!darkMode"
            class="size-4"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
            aria-hidden="true"
        >
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z" />
        </svg>

        <!-- Sun icon (light mode) -->
        <svg
            x-show="darkMode"
            class="size-4"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
            aria-hidden="true"
        >
            <circle cx="12" cy="12" r="4" />
            <path d="M12 2v2" />
            <path d="M12 20v2" />
            <path d="m4.93 4.93 1.41 1.41" />
            <path d="m17.66 17.66 1.41 1.41" />
            <path d="M2 12h2" />
            <path d="M20 12h2" />
            <path d="m6.34 17.66-1.41-1.41" />
            <path d="m19.07 4.93-1.41-1.41" />
        </svg>

        <span x-text="darkMode ? 'Light' : 'Dark'"></span>
    </button>
</div>

<!-- Toast Container -->
@if (session('toast'))
    <div
        id="toast-container"
        class="fixed top-4 right-4 z-50"
        x-data="{ show: true }"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-x-full"
        x-transition:enter-end="opacity-100 transform translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-x-0"
        x-transition:leave-end="opacity-0 transform translate-x-full"
        x-init="setTimeout(() => show = false, 5000)"
    >
        <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
            {{ session('toast') }}
            <button @click="show = false" class="ml-4 text-white hover:text-gray-200">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </div>
@endif

@livewireScripts

<!-- Additional Scripts -->
@stack('scripts')
</body>
</html>
