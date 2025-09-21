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
            <div class="card">
                <div class="card-body p-8">
                    <div class="mb-8 text-center">
                        <h1 class="mb-2 text-3xl font-bold text-gray-900">Register a new account</h1>
                        <p class="text-gray-600">Let's get started</p>
                    </div>

                    <form wire:submit="register" class="space-y-6">
                        <!-- Name Input -->
                        <div>
                            <label for="name" class="mb-2 block text-sm leading-6 font-medium text-gray-900">
                                Full Name
                            </label>
                            <input
                                id="name"
                                type="text"
                                wire:model="name"
                                placeholder="Your full name"
                                class="form-control w-full rounded-lg border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                required
                            />
                            @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Input -->
                        <div>
                            <label for="email" class="mb-2 block text-sm leading-6 font-medium text-gray-900">
                                Email
                            </label>
                            <input
                                id="email"
                                type="email"
                                wire:model="email"
                                placeholder="Your email address"
                                class="form-control w-full rounded-lg border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                required
                            />
                            @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div>
                            <label for="password" class="mb-2 block text-sm leading-6 font-medium text-gray-900">
                                Password
                            </label>
                            <input
                                id="password"
                                type="password"
                                wire:model="password"
                                placeholder="Enter your password"
                                class="form-control w-full rounded-lg border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                required
                            />
                            @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password Input -->
                        <div>
                            <label
                                for="password_confirmation"
                                class="mb-2 block text-sm leading-6 font-medium text-gray-900"
                            >
                                Confirm Password
                            </label>
                            <input
                                id="password_confirmation"
                                type="password"
                                wire:model="password_confirmation"
                                placeholder="Confirm your password"
                                class="form-control w-full rounded-lg border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                required
                            />
                            @error('password_confirmation')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button
                                type="submit"
                                class="w-full items-center gap-x-2 rounded-lg bg-blue-600 px-4 py-3 text-center font-semibold text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none disabled:pointer-events-none disabled:opacity-50"
                                wire:loading.attr="disabled"
                                wire:target="register"
                            >
                                <span wire:loading.remove wire:target="register">Create Account</span>
                                <span wire:loading wire:target="register">
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
                            </button>
                        </div>

                        <!-- Login Link -->
                        <div class="text-center">
                            <p class="mb-4 text-sm text-gray-600">Already have an account?</p>
                            <a
                                href="{{ route('login') }}"
                                    class="btn btn-ghost inline-flex w-full items-center justify-center rounded-lg border border-blue-600 bg-transparent px-4 py-2 text-sm font-medium text-blue-600 hover:bg-blue-50 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none"
                                    wire:navigate
                                >
                                    Sign in to your account
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endvolt
</x-layouts.guest>
