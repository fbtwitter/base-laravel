<header class="border-b border-zinc-200 bg-zinc-50 pt-2 lg:pt-0 dark:border-zinc-700 dark:bg-zinc-900">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between lg:h-14">
            <!-- Mobile sidebar toggle -->
            <button
                type="button"
                @click="sidebarOpen = true"
                class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition-colors duration-200 hover:bg-gray-100 hover:text-gray-500 focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-inset lg:hidden dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-gray-200"
            >
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h8m-8 6h16"
                    />
                </svg>
            </button>

            <!-- Brand/Logo for desktop -->
            <div class="flex items-center">
                <!-- Light mode logo -->
                <a href="#" wire:navigate class="flex items-center space-x-2 max-lg:hidden dark:hidden">
                    <img class="h-8 w-auto" src="https://fluxui.dev/img/demo/logo.png" alt="Acme Inc." />
                    <span class="text-xl font-semibold text-gray-900">Acme Inc.</span>
                </a>

                <!-- Dark mode logo -->
                <a href="#" wire:navigate class="hidden items-center space-x-2 max-lg:!hidden dark:flex">
                    <img
                        class="h-8 w-auto"
                        src="https://fluxui.dev/img/demo/dark-mode-logo.png"
                        alt="Acme Inc."
                    />
                    <span class="text-xl font-semibold text-white">Acme Inc.</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <nav class="flex items-center space-x-4 max-lg:hidden">
                <a
                    href="/"
                    wire:navigate
                    class="flex items-center space-x-2 rounded-md px-3 py-2 text-sm font-medium text-gray-700 transition-colors duration-200 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
                        />
                    </svg>
                    <span>Home</span>
                </a>

                <!-- Separator -->
                <div class="my-2 h-6 w-px bg-gray-300 dark:bg-gray-600"></div>

                <a
                    href="/playground"
                    wire:navigate
                    class="flex items-center space-x-2 rounded-md px-3 py-2 text-sm font-medium text-gray-700 transition-colors duration-200 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z"
                        />
                    </svg>
                    <span>Playground</span>
                </a>
            </nav>

            <!-- Spacer -->
            <div class="flex-1"></div>

            <!-- Profile Dropdown -->
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
                        href="{{ route('profile.update') ?? '/profile' }}"
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
                </div>
            </div>
        </div>
    </div>
</header>
