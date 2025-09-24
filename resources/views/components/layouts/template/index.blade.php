<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="{{ config('app.description', 'A Laravel application') }}" />
    <title>{{ config('app.name', 'My Laravel App') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <!-- Fonts -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400..600&display=swap" as="style"
          onload="this.onload=null;this.rel='stylesheet'" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400..600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-gray-50 dark:bg-zinc-800">
<main>
    {{ $slot }}
</main>

<!-- Dark mode toggle -->
<div class="fixed right-4 bottom-4 z-40" x-data="appToggle" wire:ignore>
    <x-modules.dark-mode-toggle />
</div>

<!-- Additional Scripts -->
@livewireScripts

<!-- Alpine.js Logic -->
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('appToggle', () => ({
            darkMode:
                localStorage.getItem('darkMode') === 'true' ||
                (!localStorage.getItem('darkMode') &&
                    window.matchMedia('(prefers-color-scheme: dark)').matches),
            init() {
                if (this.darkMode) {
                    document.documentElement.classList.add('dark')
                }
            },
        }))
    })
</script>

@stack('scripts')
</body>
</html>
