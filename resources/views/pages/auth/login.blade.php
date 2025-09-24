<?php

use function Laravel\Folio\{middleware, name};

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

<x-layouts.template.guest>
    <div class="mx-auto max-w-md rounded-lg p-4 shadow-md">
        @volt('pages.auth.login')
            <div class="flex min-h-full flex-1 flex-col justify-center py-4 lg:px-8">
                <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                    <div class="mb-8 text-center">
                        <h1 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Log in</h1>
                        <p class="text-gray-600 dark:text-white">Welcome back buddy!</p>
                    </div>
                    <form wire:submit="login" class="space-y-6">
                        <x-elements.form-field.input
                            label="Email"
                            type="email"
                            placeholder="Your email address"
                            model="form.email"
                            error-key="form.email"
                            :required="true"
                        />

                        <x-elements.form-field.input
                            label="Password"
                            type="password"
                            placeholder="Your Password"
                            model="form.password"
                            error-key="form.password"
                            :forgot="true"
                            :required="true"
                        />

                        <x-elements.form-field.checkbox label="Remember me" />

                        <div class="space-y-4">
                            <x-base.button type="submit" full-width="true">Log in</x-base.button>

                            <div class="text-center">
                                <x-elements.icon-button
                                    icon="user-plus"
                                    href="{{ route('register') }}"
                                    variant="ghost"
                                    wire:navigate
                                >
                                    Sign up for a new account
                                </x-elements.icon-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endvolt
    </div>
</x-layouts.template.guest>
