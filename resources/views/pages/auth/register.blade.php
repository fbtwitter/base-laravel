<?php

use function Laravel\Folio\{middleware, name};

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Volt\Component;

middleware(["guest"]);
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
    <div class="max-w-md mx-auto bg-white p-4 rounded-lg shadow-md">
        @volt('pages.auth.register')
        <div class="flex min-h-full flex-1 flex-col justify-center py-4 lg:px-8">
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
                    <div class="space-y-4">
                        <x-elements.icon-button
                                type="submit"
                                class="w-full justify-center"
                                wire:loading.attr="disabled"
                        >
                        <span wire:loading.remove>
                           Create Account
                        </span>
                            <span wire:loading>
                           <div class="flex gap-1 items-center">
                                <x-base.icon icon-name="loader-circle" stroke-width="2.75" class="animate-spin
                                inline-block w-5 h-5" role="status" aria-label="loading" />
                            Creating Account...
                           </div>
                        </span>
                        </x-elements.icon-button>

                        <!-- Login Link -->
                        <div class="text-center">
                            <x-elements.icon-button
                                    href="{{ route('login') }}"
                                variant="ghost"
                                color="secondary"
                                wire:navigate
                            >
                                Already have an account
                            </x-elements.icon-button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
        @endvolt
    </div>
</x-layouts.guest>
