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
        <x-modules.nav-header />

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
