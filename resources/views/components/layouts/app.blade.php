<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
};
?>

<x-layouts.base>
    <div class="h-screen">
        <!-- Header -->
        @volt
        <x-molecules.header />
        @endvolt

        <!-- Mobile Sidebar Overlay -->
        <div
            x-show="sidebarOpen"
            x-transition:enter="transition-opacity duration-300 ease-linear"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity duration-300 ease-linear"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="bg-opacity-75 fixed inset-0 z-40 bg-gray-600 lg:hidden"
            @click="sidebarOpen = false"
        ></div>

        <!-- Mobile Sidebar -->
        <div
            x-show="sidebarOpen"
            x-transition:enter="transform transition duration-300 ease-in-out"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transform transition duration-300 ease-in-out"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="fixed top-0 bottom-0 left-0 z-50 w-64 overflow-y-auto border-r border-zinc-200 bg-zinc-50 lg:hidden dark:border-zinc-700 dark:bg-zinc-900"
        >
            <!-- Sidebar Header -->
            <div class="flex items-center justify-between px-4 pt-4 pb-2">
                <!-- Close button -->
                <button
                    type="button"
                    @click="sidebarOpen = false"
                    class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition-colors duration-200 hover:bg-gray-100 hover:text-gray-500 focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-inset dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                >
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>

            <!-- Mobile Brand -->
            <div class="px-4 pb-4">
                <!-- Light mode logo -->
                <a href="/" wire:navigate class="flex items-center space-x-2 dark:hidden">
                    <img class="h-8 w-auto" src="https://fluxui.dev/img/demo/logo.png" alt="Acme Inc." />
                    <span class="text-xl font-semibold text-gray-900">Acme Inc.</span>
                </a>

                <!-- Dark mode logo -->
                <a href="/" wire:navigate class="hidden items-center space-x-2 dark:flex">
                    <img class="h-8 w-auto" src="https://fluxui.dev/img/demo/dark-mode-logo.png" alt="Acme Inc." />
                    <span class="text-xl font-semibold text-white">Acme Inc.</span>
                </a>
            </div>

            <!-- Mobile Navigation -->
            <nav class="px-4 pb-4">
                <div class="space-y-1">
                    <a
                        href="/"
                        wire:navigate
                        @click="sidebarOpen = false"
                        class="flex items-center gap-x-3 rounded-lg border border-transparent px-3 py-2 text-sm text-gray-700 transition-colors duration-200 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white"
                    >
                        <svg
                            class="size-4"
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
                            <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9,22 9,12 15,12 15,22" />
                        </svg>
                        Home
                    </a>

                    <a
                        href="/playground"
                        wire:navigate
                        @click="sidebarOpen = false"
                        class="flex items-center gap-x-3 rounded-lg border border-transparent px-3 py-2 text-sm text-gray-700 transition-colors duration-200 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white"
                    >
                        <svg
                            class="size-4"
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
                            <path
                                d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z"
                            />
                        </svg>
                        Playground
                    </a>
                </div>
            </nav>
        </div>

        <!-- Main Content Area -->
        <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            {{-- <div class="flex-1 self-stretch max-md:pt-6 py-8"> --}}
            {{-- <!-- Your main content goes here (equivalent to $slot) --> --}}
            {{-- <div x-data="mainContent"> --}}
            {{-- <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Welcome to Your App</h1> --}}

            {{-- <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6"> --}}
            {{-- <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Preline UI v3.2.1 + Alpine --}}
            {{-- + --}}
            {{-- Livewire + Volt</h2> --}}
            {{-- <p class="text-gray-600 dark:text-gray-400 mb-4"> --}}
            {{-- This layout is now fully integrated with: --}}
            {{-- </p> --}}

            {{-- <ul class="list-disc list-inside text-gray-600 dark:text-gray-400 space-y-2"> --}}
            {{-- <li><strong>Preline UI v3.2.1:</strong> Latest version with enhanced components</li> --}}
            {{-- <li><strong>Alpine.js:</strong> Client-side reactivity and state management</li> --}}
            {{-- <li><strong>Livewire:</strong> Server-side interactions with wire:navigate and wire:click --}}
            {{-- </li> --}}
            {{-- <li><strong>Volt:</strong> Ready for single-file components</li> --}}
            {{-- <li><strong>Responsive Design:</strong> Mobile-first with smooth transitions</li> --}}
            {{-- <li><strong>Dark Mode:</strong> Complete theme switching support</li> --}}
            {{-- </ul> --}}

            {{-- <!-- Demo Alpine component --> --}}
            {{-- <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg"> --}}
            {{-- <h3 class="text-lg font-medium text-blue-900 dark:text-blue-100 mb-2">Alpine.js Integration --}}
            {{-- Demo</h3> --}}
            {{-- <button @click="showMessage = !showMessage" --}}
            {{-- class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200"> --}}
            {{-- Toggle Message --}}
            {{-- </button> --}}
            {{-- <p x-show="showMessage" --}}
            {{-- x-transition --}}
            {{-- class="mt-2 text-blue-800 dark:text-blue-200 text-sm"> --}}
            {{-- Alpine.js is working perfectly with Preline UI! --}}
            {{-- </p> --}}
            {{-- </div> --}}

            {{-- <!-- Livewire integration example --> --}}
            {{-- <div class="mt-4 p-4 bg-green-50 dark:bg-green-900/20 rounded-lg"> --}}
            {{-- <h3 class="text-lg font-medium text-green-900 dark:text-green-100 mb-2">Livewire --}}
            {{-- Integration</h3> --}}
            {{-- <p class="text-green-800 dark:text-green-200 text-sm"> --}}
            {{-- All navigation links use <code class="px-1 bg-green-200 dark:bg-green-800 rounded">wire:navigate</code> --}}
            {{-- and the logout button uses <code class="px-1 bg-green-200 dark:bg-green-800 rounded">wire:click="logout"</code> --}}
            {{-- </p> --}}
            {{-- </div> --}}
            {{-- </div> --}}
            {{-- </div> --}}
            {{-- </div> --}}
            {{ $slot }}
        </main>

        <!-- Toast notifications area (Livewire compatible) -->
        <div
            id="toast-container"
            class="fixed top-4 right-4 z-50 space-y-2"
            x-data="toastManager"
            @toast.window="addToast($event.detail)"
        >
            <template x-for="toast in toasts" :key="toast.id">
                <div
                    x-show="toast.show"
                    x-transition:enter="transform transition duration-300 ease-out"
                    x-transition:enter-start="translate-y-2 opacity-0 sm:translate-x-2 sm:translate-y-0"
                    x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                    x-transition:leave="transition duration-100 ease-in"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="flex w-full max-w-xs items-center rounded-lg bg-white p-4 text-gray-500 shadow dark:bg-gray-800 dark:text-gray-400"
                    :class="{
                    'border-l-4 border-green-500': toast.type === 'success',
                    'border-l-4 border-red-500': toast.type === 'error',
                    'border-l-4 border-yellow-500': toast.type === 'warning'
                 }"
                >
                    <div class="ml-3 text-sm font-normal" x-text="toast.message"></div>
                    <button
                        type="button"
                        @click="removeToast(toast.id)"
                        class="-mx-1.5 -my-1.5 ml-auto inline-flex h-8 w-8 rounded-lg bg-white p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-900 focus:ring-2 focus:ring-gray-300 dark:bg-gray-800 dark:text-gray-500 dark:hover:bg-gray-700 dark:hover:text-white"
                    >
                        <svg class="h-3 w-3" fill="none" viewBox="0 0 14 14">
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                            />
                        </svg>
                    </button>
                </div>
            </template>
        </div>
    </div>
</x-layouts.base>

<script>
    // Alpine.js components
    document.addEventListener('alpine:init', () => {
        // Main content component
        Alpine.data('mainContent', () => ({
            showMessage: false,
        }))

        // Toast manager component
        Alpine.data('toastManager', () => ({
            toasts: [],
            nextId: 1,

            addToast(data) {
                const toast = {
                    id: this.nextId++,
                    message: data.message || 'Notification',
                    type: data.type || 'info',
                    show: true,
                }

                this.toasts.push(toast)

                // Auto-remove after 5 seconds
                setTimeout(() => {
                    this.removeToast(toast.id)
                }, 5000)
            },

            removeToast(id) {
                const index = this.toasts.findIndex((toast) => toast.id === id)
                if (index > -1) {
                    this.toasts[index].show = false
                    setTimeout(() => {
                        this.toasts.splice(index, 1)
                    }, 300)
                }
            },
        }))
    })

    // Toast helper function for Livewire
    function showToast(message, type = 'info') {
        window.dispatchEvent(
            new CustomEvent('toast', {
                detail: { message, type },
            }),
        )
    }

    // Demo toast on load
    setTimeout(() => {
        showToast('Preline UI v3.2.1 with Alpine & Livewire ready!', 'success')
    }, 1000)

    // Initialize Preline UI
    window.addEventListener('load', () => {
        if (window.HSStaticMethods) {
            window.HSStaticMethods.autoInit()
        }
    })

    // Livewire navigation events (if needed)
    document.addEventListener('livewire:navigated', () => {
        if (window.HSStaticMethods) {
            window.HSStaticMethods.autoInit()
        }
    })
</script>
