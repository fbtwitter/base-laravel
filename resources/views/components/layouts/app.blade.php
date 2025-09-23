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
    <body class="hs-overlay-body-open hs-overlay-body-open:overflow-hidden">
    <x-modules.sidebar />

    <!-- Content -->
    <div class="sm:hs-overlay-layout-open:ms-64 min-h-screen bg-white transition-all duration-300 dark:bg-neutral-800">
        <!-- Navigation Toggle -->
        <div class="p-2">
            <button type="button"
                    class="flex justify-center items-center gap-x-3 size-8 text-sm text-gray-600 hover:bg-gray-100 rounded-full disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:hover:text-neutral-200 dark:focus:text-neutral-200"
                    aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-sidebar-content-push"
                    aria-label="Toggle navigation" data-hs-overlay="#hs-sidebar-content-push">
                <svg class="sm:hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                     stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="2" />
                    <path d="M15 3v18" />
                    <path d="m8 9 3 3-3 3" />
                </svg>
                <svg class="hidden sm:block shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                     stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="2" />
                    <path d="M15 3v18" />
                    <path d="m10 15-3-3 3-3" />
                </svg>
                <span class="sr-only">Navigation Toggle</span>
            </button>
        </div>
        <!-- End Navigation Toggle -->

        {{--        <header class="mb-6 w-full max-w-[335px] text-sm not-has-[nav]:hidden lg:max-w-4xl">--}}
        {{--            <nav class="flex items-center justify-end gap-4">--}}
        {{--                @auth--}}
        {{--                    <a--}}
        {{--                        href="{{ url('/dashboard') }}"--}}
        {{--                        class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"--}}
        {{--                    >--}}
        {{--                        Dashboard--}}
        {{--                    </a>--}}
        {{--                @else--}}
        {{--                    <a--}}
        {{--                        href="{{ route('login') }}"--}}
        {{--                        class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]"--}}
        {{--                    >--}}
        {{--                        Log in--}}
        {{--                    </a>--}}

        {{--                    @if (Route::has('register'))--}}
        {{--                        <a--}}
        {{--                            href="{{ route('register') }}"--}}
        {{--                            class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"--}}
        {{--                        >--}}
        {{--                            Register--}}
        {{--                        </a>--}}
        {{--                    @endif--}}
        {{--                @endauth--}}
        {{--            </nav>--}}
        {{--            @if (Route::has('login'))--}}
        {{--                <nav class="flex items-center justify-end gap-4">--}}
        {{--                    @auth--}}
        {{--                        <a--}}
        {{--                            href="{{ url('/dashboard') }}"--}}
        {{--                            class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"--}}
        {{--                        >--}}
        {{--                            Dashboard--}}
        {{--                        </a>--}}
        {{--                    @else--}}
        {{--                        <a--}}
        {{--                            href="{{ route('login') }}"--}}
        {{--                            class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]"--}}
        {{--                        >--}}
        {{--                            Log in--}}
        {{--                        </a>--}}

        {{--                        @if (Route::has('register'))--}}
        {{--                            <a--}}
        {{--                                href="{{ route('register') }}"--}}
        {{--                                class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"--}}
        {{--                            >--}}
        {{--                                Register--}}
        {{--                            </a>--}}
        {{--                        @endif--}}
        {{--                    @endauth--}}
        {{--                </nav>--}}
        {{--            @endif--}}
        {{--        </header>--}}

        <main class="h-full flex justify-center items-center">
            {{ $slot }}
        </main>
    </div>
    <!-- End Content -->


    </body>
</x-layouts.base>
