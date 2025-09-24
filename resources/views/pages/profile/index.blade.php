<?php

use App\Models\User;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

use function Laravel\Folio\{middleware, name};

middleware(['auth']);

name('profile.update');

new class extends Component {
    public string $name = '';
    public string $email = '';

    // Update Password Properties
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    // Delete User Property
    public string $delete_password = '';

    public bool $showDeleteModal = false;

    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        session()->flash('status', 'Profile updated successfully.');
    }

    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));
            return;
        }

        $user->sendEmailVerificationNotification();

        session()->flash('status', 'Verification link sent!');
    }

    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');
            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        session()->flash('status', 'Password updated successfully.');
    }

    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'delete_password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        session()->flash('status', 'Account deleted successfully.');

        $this->redirect('/', navigate: true);
    }
}; ?>

<x-layouts.template.app>
    @if (session('status'))
        <div class="mb-4 rounded-md border border-green-400 bg-green-100 p-4 text-sm text-green-700">
            {{ session('status') }}
        </div>
    @endif

    @volt('pages.profile.update')
        <div class="space-y-6">
            <div class="rounded-lg bg-white p-6 shadow-md">
                <form wire:submit="updateProfileInformation" class="space-y-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Profile Information</h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Update your account's profile information and email address.
                        </p>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input
                                wire:model="name"
                                type="text"
                                id="name"
                                class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none sm:text-sm"
                                placeholder="Your name"
                                required
                                autofocus
                            />
                            @error('name')
                                <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input
                                wire:model="email"
                                type="email"
                                id="email"
                                class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none sm:text-sm"
                                placeholder="Your email address"
                                required
                            />
                            @error('email')
                                <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&! auth()->user()->hasVerifiedEmail())
                            <div class="mt-2 text-sm text-gray-800">
                                Your email address is unverified.
                                <button
                                    wire:click.prevent="sendVerification"
                                    class="ml-1 font-medium text-indigo-600 underline hover:text-indigo-500"
                                >
                                    Click here to re-send the verification email.
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="flex items-center justify-end gap-4">
                        <button
                            type="submit"
                            class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-none"
                        >
                            Save
                        </button>
                    </div>
                </form>
            </div>

            <div class="rounded-lg bg-white p-6 shadow-md">
                <form wire:submit="updatePassword" class="space-y-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Update Password</h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Ensure your account is using a long, random password to stay secure.
                        </p>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700">
                                Current Password
                            </label>
                            <input
                                wire:model="current_password"
                                type="password"
                                id="current_password"
                                class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none sm:text-sm"
                                required
                            />
                            @error('current_password')
                                <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                            <input
                                wire:model="password"
                                type="password"
                                id="password"
                                class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none sm:text-sm"
                                required
                            />
                            @error('password')
                                <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                Confirm Password
                            </label>
                            <input
                                wire:model="password_confirmation"
                                type="password"
                                id="password_confirmation"
                                class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none sm:text-sm"
                                required
                            />
                            @error('password_confirmation')
                                <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4">
                        <button
                            type="submit"
                            class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-none"
                        >
                            Update Password
                        </button>
                    </div>
                </form>
            </div>

            <div class="rounded-lg bg-white p-6 shadow-md">
                <div class="space-y-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Delete Account</h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Once your account is deleted, all of its resources and data will be permanently deleted.
                        </p>
                    </div>

                    <button
                        wire:click="$set('showDeleteModal', true)"
                        class="inline-flex justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:outline-none"
                    >
                        Delete Account
                    </button>

                    @if ($showDeleteModal)
                        <div class="bg-opacity-50 fixed inset-0 z-50 h-full w-full overflow-y-auto bg-gray-600">
                            <div class="relative top-20 mx-auto w-96 rounded-md border bg-white p-5 shadow-lg">
                                <form wire:submit="deleteUser">
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900">
                                            Are you sure you want to delete your account?
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-600">
                                            Once your account is deleted, all of its resources and data will be
                                            permanently deleted.
                                        </p>
                                    </div>

                                    <div class="mt-6">
                                        <label for="delete_password" class="block text-sm font-medium text-gray-700">
                                            Password
                                        </label>
                                        <input
                                            wire:model="delete_password"
                                            type="password"
                                            id="delete_password"
                                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none sm:text-sm"
                                            placeholder="Password"
                                            required
                                        />
                                        @error('delete_password')
                                            <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mt-6 flex justify-end gap-2">
                                        <button
                                            wire:click="$set('showDeleteModal', false)"
                                            type="button"
                                            class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-none"
                                        >
                                            Cancel
                                        </button>

                                        <button
                                            type="submit"
                                            class="rounded-md border border-transparent bg-red-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:outline-none"
                                        >
                                            Delete Account
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endvolt
</x-layouts.template.app>
