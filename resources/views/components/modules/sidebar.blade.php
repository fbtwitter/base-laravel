@props([
    'menuItems' => [],
    'brandName' => 'Brand',
    'brandUrl' => '/',
    'logoLight' => 'https://fluxui.dev/img/demo/logo.png',
    'logoDark' => 'https://fluxui.dev/img/demo/dark-mode-logo.png',
])

<!-- Sidebar -->
<!-- Sidebar Backdrop for Mobile -->
<div
    x-show="sidebarOpen"
    x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @click="sidebarOpen = false"
    class="fixed inset-0 z-50 bg-gray-900/50 sm:hidden"
    x-cloak
    aria-hidden="true"
></div>


<aside
    id="sidebar"
    x-show="sidebarOpen"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
    x-cloak
    class="fixed inset-y-0 left-0 z-50 w-64 transform border-e border-gray-200 bg-white shadow-xl transition-transform duration-300
    ease-in-out dark:bg-neutral-900 dark:border-neutral-700 lg:inset-0 lg:z-auto lg:translate-x-0
    lg:shadow-none"
    :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }"
    tabindex="-1"
    role="navigation"
    aria-label="Main Navigation"
>
    <div class="relative flex h-full max-h-full flex-col">
        <!-- Header -->
        <header class="flex items-center justify-between gap-x-2 p-4">
            <!-- Brand/Logo for desktop -->
            <div class="flex items-center">
                <!-- Light mode logo -->
                <a href="{{ $brandUrl }}"
                   wire:navigate
                   class="flex items-center space-x-3 transition-opacity hover:opacity-80"
                   aria-label="{{ $brandName }} Home">

                    <!-- Light Mode Logo -->
                    <img
                        class="h-8 w-auto dark:hidden"
                        src="{{ $logoLight }}"
                        alt="{{ $brandName }}"
                        loading="lazy"
                    />
                    <!-- Dark Mode Logo -->
                    <img
                        class="hidden h-8 w-auto dark:block"
                        src="{{ $logoDark }}"
                        alt="{{ $brandName }}"
                        loading="lazy"
                    />
                    <span class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ $brandName }}
                    </span>
                </a>
            </div>

            <div class="-me-2 sm:hidden">
                <!-- Close Button -->
                <button
                    type="button"
                    @click="sidebarOpen = false"
                    class="flex size-6 items-center justify-center gap-x-3 rounded-full border border-gray-200 bg-white text-sm text-gray-600 hover:bg-gray-100 focus:bg-gray-100 focus:outline-hidden disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-200 dark:focus:bg-neutral-700 dark:focus:text-neutral-200"
                >
                    <svg
                        class="size-4 shrink-0"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                    <span class="sr-only">Close</span>
                </button>
                <!-- End Close Button -->
            </div>
        </header>
        <!-- End Header -->

        <!-- Body -->
        <nav
            class="h-full overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 [&::-webkit-scrollbar-track]:bg-gray-100 dark:[&::-webkit-scrollbar-track]:bg-neutral-700"
        >
            <ul class="space-y-1 px-2 pb-0">
                <x-elements.menu.item
                    label="Dashboard"
                    icon='<svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" /><polyline points="9 22 9 12 15 12 15 22" /></svg>'
                    active="true"
                />

                <x-elements.menu.item
                    label="Users"
                    icon='<svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" /><circle cx="9" cy="7" r="4" /><path d="M22 21v-2a4 4 0 0 0-3-3.87" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /></svg>'
                    :subItems="[
                        [
                            'label' => 'Sub Menu 1',
                            'items' => [
                                ['label' => 'Link 1 ini atau ini', 'href' => '#'],
                                ['label' => 'Link 2', 'href' => '#'],
                                ['label' => 'Link 3', 'href' => '#']
                            ]
                        ],
                        [
                            'label' => 'Sub Menu 2',
                            'items' => [
                                ['label' => 'Link 1', 'href' => '#'],
                                ['label' => 'Link 2', 'href' => '#'],
                                ['label' => 'Link 3', 'href' => '#']
                            ]
                        ]
                    ]"
                />

                <x-elements.menu.item
                    label="Documentation"
                    icon='<svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" /><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" /></svg>'
                />
            </ul>
        </nav>
        <!-- End Body -->

        <!-- Sidebar Footer (Optional) -->
        <footer class="border-t border-gray-200 px-3 py-4 dark:border-neutral-700">
            <div class="flex items-center text-sm text-gray-500 dark:text-neutral-400">
                <svg class="mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                          clip-rule="evenodd"></path>
                </svg>
                <span>v1.0.0</span>
            </div>
        </footer>
    </div>
</aside>
<!-- End Sidebar -->
