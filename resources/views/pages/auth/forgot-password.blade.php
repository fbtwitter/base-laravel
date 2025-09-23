<?php

use Illuminate\Support\Facades\Password;
use Livewire\Volt\Component;

use function Laravel\Folio\name;

name('password.request');

new class extends Component {
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink($this->only('email'));

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<x-layouts.guest>
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        @volt('pages.auth.forgot-password')
        <form wire:submit="sendPasswordResetLink" class="space-y-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Reset your password</h1>
                <p class="mt-1 text-sm text-gray-600">Enter your email to receive a password reset link</p>
            </div>

            <div class="space-y-6">
                <!-- Email Input -->
                <x-elements.form-field.input
                    label="Email"
                    type="email"
                    placeholder="Your email address"
                    model="email"
                    error-key="email"
                    :required="true"
                    autofocus
                />
            </div>

            @if (session('status'))
                <div class="text-green-600 text-sm">{{ session('status') }}</div>
            @endif

            <div class="space-y-2">
                <x-base.button
                    type="submit"
                    color="primary"
                    full-width="true"
                >
                    Email Password Reset Link
                </x-base.button>

                <x-elements.icon-button
                    href="{{ route('login') }}"
                    wire:navigate
                    color="secondary"
                    variant="white"
                    class="w-full"
                >
                    Back to login
                </x-elements.icon-button>
            </div>
        </form>
        @endvolt
    </div>
</x-layouts.guest>
