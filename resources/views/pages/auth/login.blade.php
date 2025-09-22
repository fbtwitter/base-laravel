<?php

use function Laravel\Folio\name;

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Volt\Component;

name('login');

new class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
};
?>

<x-layouts.guest>
    @volt('pages.auth.login')
    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <div class="card">
                <div class="card-body p-8">
                    <div class="mb-8 text-center">
                        <h1 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Log in to your account</h1>
                        <p class="text-gray-600 dark:text-white">Welcome back!</p>
                    </div>

                    <form wire:submit="login" class="space-y-6">
                        <!-- Email Input -->
                        <x-molecules.forms.input
                            label="Email"
                            type="email"
                            placeholder="Your email address"
                            model="form.email"
                            error-key="form.email"
                            :required="true" />

                        <!-- Password Field -->
                        <x-molecules.forms.input
                            label="Password"
                            type="password"
                            placeholder="Your Password"
                            model="form.password"
                            error-key="form.password"
                            :forgot="true"
                            :required="true" />


                        <!-- Remember Me Checkbox -->
                        <x-molecules.forms.checkbox label="Remember me" />
                       

                        <!-- Submit Button -->
                        <div>
                            <x-molecules.button
                                type="submit"
                                class="w-full items-center gap-x-2 rounded-lg bg-blue-600 px-4 py-3 text-center font-semibold text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none disabled:pointer-events-none disabled:opacity-50"
                            >
                                Log in
                            </x-molecules.button>
                        </div>

                        <!-- Register Link -->
                        <div class="text-center">
                            <a
                                href="{{ route('register') }}"
                                class="inline-flex items-center rounded-lg border border-transparent bg-blue-50 px-4 py-2 text-sm font-medium text-blue-600 hover:bg-blue-100 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none"
                                wire:navigate
                            >
                                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"
                                    ></path>
                                </svg>
                                Sign up for a new account
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endvolt
</x-layouts.guest>
