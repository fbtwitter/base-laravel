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

<!-- Navigation Toggle -->
<header class="sticky top-0 z-10 w-full border-b border-gray-200 bg-white dark:border-neutral-800">
    <div class="flex justify-between px-5 py-2.5">
        <button
            type="button"
            @click="sidebarOpen = !sidebarOpen"
            class="flex size-10 items-center justify-center gap-x-3 rounded-full text-sm text-gray-600 hover:bg-gray-100 focus:bg-gray-100 focus:outline-hidden disabled:pointer-events-none disabled:opacity-50 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-200 dark:focus:bg-neutral-700 dark:focus:text-neutral-200"
            aria-haspopup="dialog"
            aria-expanded="false"
            aria-controls="hs-sidebar-content-push"
            aria-label="Toggle navigation"
        >
            <svg
                class="size-4 shrink-0 sm:hidden"
                :class="{ 'hidden': sidebarOpen, 'block': !sidebarOpen }"
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
                <rect width="18" height="18" x="3" y="3" rx="2" />
                <path d="M15 3v18" />
                <path d="m8 9 3 3-3 3" />
            </svg>
            <svg
                class="size-4 shrink-0 sm:block"
                :class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }"
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
                <rect width="18" height="18" x="3" y="3" rx="2" />
                <path d="M15 3v18" />
                <path d="m10 15-3-3 3-3" />
            </svg>
            <span class="sr-only">Navigation Toggle</span>
        </button>

        <!-- Profile Dropdown -->
        <div>
            <div class="hs-dropdown relative" x-data="{ open: false }" @click.outside="open = false">
                <button
                    type="button"
                    @click="open = !open"
                    class="hs-dropdown-toggle inline-flex items-center gap-x-2 rounded-lg border border-transparent px-3 py-2 text-sm font-medium text-gray-800 transition-colors duration-200 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-gray-800 dark:focus:bg-gray-800"
                    :class="{ 'bg-gray-100 dark:bg-gray-800': open }"
                >
                    <!-- Replace with actual user name from auth -->
                    <span>{{ auth()->user()->name ?? 'John Doe' }}</span>
                    <svg
                        class="size-4 transition-transform duration-200"
                        :class="{ 'rotate-180': open }"
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
                        <path d="m6 9 6 6 6-6" />
                    </svg>
                </button>

                <div
                    x-show="open"
                    x-transition:enter="transition duration-200 ease-out"
                    x-transition:enter-start="scale-95 opacity-0"
                    x-transition:enter-end="scale-100 opacity-100"
                    x-transition:leave="transition duration-150 ease-in"
                    x-transition:leave-start="scale-100 opacity-100"
                    x-transition:leave-end="scale-95 opacity-0"
                    class="absolute right-0 z-50 mt-2 w-60 origin-top-right rounded-lg bg-white p-2 shadow-lg dark:border dark:border-gray-700 dark:bg-gray-800"
                >
                    <a
                        class="flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 transition-colors duration-200 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700"
                        href="{{ route('profile.update') }}"
                        wire:navigate
                    >
                        <svg
                            class="size-4 flex-shrink-0"
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
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                            />
                        </svg>
                        Profile
                    </a>

                    @volt('logout')
                        <button
                            type="button"
                            wire:click="logout"
                            class="flex w-full items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 transition-colors duration-200 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700"
                        >
                            <svg
                                class="size-4 flex-shrink-0"
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
                                <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4m7 14l5-5-5-5m5 5H9" />
                            </svg>
                            Logout
                        </button>
                    @endvolt
                </div>
            </div>
        </div>
    </div>
</header>
<!-- End Navigation Toggle -->
