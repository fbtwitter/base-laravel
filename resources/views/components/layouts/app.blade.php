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
    <x-organisms.sidebar />
    <!-- Content -->
    <div class="sm:hs-overlay-layout-open:ms-64 min-h-160 bg-white transition-all duration-300 dark:bg-neutral-800">
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
    </div>
    <!-- End Content -->
    </body>
</x-layouts.base>
