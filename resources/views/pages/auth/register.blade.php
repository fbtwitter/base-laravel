<?php

use function Laravel\Folio\name;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Volt\Component;

name('register');

new class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
};
?>

<x-layouts.guest>
    @volt('pages.auth.register')
    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <div class="mb-8 text-center">
                <h1 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Register a new account</h1>
                <p class="text-gray-600 dark:text-white">Let's get started</p>
            </div>
            <form wire:submit="register" class="space-y-6">
                <!-- Name Input -->
                <x-elements.form-field.input
                    label="Full Name"
                    type="text"
                    placeholder="Your full name"
                    model="name"
                    error-key="name"
                    :required="true"
                />

                <!-- Email Input -->
                <x-elements.form-field.input
                    label="Email"
                    type="email"
                    placeholder="Your email address"
                    model="email"
                    error-key="email"
                    :required="true"
                />

                <!-- Password Input -->
                <x-elements.form-field.input
                    label="Password"
                    type="password"
                    placeholder="Enter your password"
                    model="password"
                    error-key="password"
                    :required="true"
                />

                <!-- Confirm Password Input -->
                <x-elements.form-field.input
                    label="Confirm Password"
                    type="password"
                    placeholder="Confirm your password"
                    model="password_confirmation"
                    error-key="password_confirmation"
                    :required="true"
                />

                <!-- Submit Button -->
                <div>
                    <x-base.button
                        type="submit"
                        class="w-full justify-center"
                        wire:loading.attr="disabled"
                    >
                        <span wire:loading.remove>Create Account</span>
                        <span wire:loading>
                            <svg
                                class="mr-3 -ml-1 inline h-5 w-5 animate-spin text-white"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <circle
                                    class="opacity-25"
                                    cx="12"
                                    cy="12"
                                    r="10"
                                    stroke="currentColor"
                                    stroke-width="4"
                                ></circle>
                                <path
                                    class="opacity-75"
                                    fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                ></path>
                            </svg>
                            Creating Account...
                        </span>
                    </x-base.button>
                </div>

                <!-- Login Link -->
                <div class="text-center">
                    <p class="mb-4 text-sm text-gray-600">Already have an account?</p>
                    <x-elements.icon-button
                        icon="user-plus"
                        href="{{ route('login') }}"
                        variant="outline"
                        wire:navigate
                    >
                        Sign in to your account
                    </x-elements.icon-button>
                </div>
            </form>
        </div>
    </div>
    @endvolt
</x-layouts.guest>
