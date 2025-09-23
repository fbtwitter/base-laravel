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

<x-layouts.app>
    @if (session('status'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md text-sm">
            {{ session('status') }}
        </div>
    @endif

    @volt('pages.profile.update')
    <div class="space-y-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <form wire:submit="updateProfileInformation" class="space-y-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Profile Information</h2>
                    <p class="mt-1 text-sm text-gray-600">Update your account's profile information and email
                        address.</p>
                </div>

                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input
                            wire:model="name"
                            type="text"
                            id="name"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="Your name"
                            required
                            autofocus
                        />
                        @error('name') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input
                            wire:model="email"
                            type="email"
                            id="email"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="Your email address"
                            required
                        />
                        @error('email') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                        <div class="mt-2 text-sm text-gray-800">
                            Your email address is unverified.
                            <button wire:click.prevent="sendVerification"
                                    class="ml-1 text-indigo-600 hover:text-indigo-500 underline font-medium">
                                Click here to re-send the verification email.
                            </button>
                        </div>
                    @endif
                </div>

                <div class="flex items-center justify-end gap-4">
                    <button
                        type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Save
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <form wire:submit="updatePassword" class="space-y-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Update Password</h2>
                    <p class="mt-1 text-sm text-gray-600">Ensure your account is using a long, random password to stay
                        secure.</p>
                </div>

                <div class="space-y-6">
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700">Current
                            Password</label>
                        <input
                            wire:model="current_password"
                            type="password"
                            id="current_password"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required
                        />
                        @error('current_password') <span
                            class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                        <input
                            wire:model="password"
                            type="password"
                            id="password"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required
                        />
                        @error('password') <span class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                            Password</label>
                        <input
                            wire:model="password_confirmation"
                            type="password"
                            id="password_confirmation"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required
                        />
                        @error('password_confirmation') <span
                            class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4">
                    <button
                        type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Update Password
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="space-y-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Delete Account</h2>
                    <p class="mt-1 text-sm text-gray-600">Once your account is deleted, all of its resources and data
                        will be permanently deleted.</p>
                </div>

                <button
                    wire:click="$set('showDeleteModal', true)"
                    class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                >
                    Delete Account
                </button>

                @if($showDeleteModal)
                    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                            <form wire:submit="deleteUser">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">Are you sure you want to delete your
                                        account?</h3>
                                    <p class="mt-1 text-sm text-gray-600">
                                        Once your account is deleted, all of its resources and data will be permanently
                                        deleted.
                                    </p>
                                </div>

                                <div class="mt-6">
                                    <label for="delete_password" class="block text-sm font-medium text-gray-700">Password</label>
                                    <input
                                        wire:model="delete_password"
                                        type="password"
                                        id="delete_password"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="Password"
                                        required
                                    />
                                    @error('delete_password') <span
                                        class="text-red-600 text-sm mt-1">{{ $message }}</span> @enderror
                                </div>

                                <div class="mt-6 flex justify-end gap-2">
                                    <button
                                        wire:click="$set('showDeleteModal', false)"
                                        type="button"
                                        class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    >
                                        Cancel
                                    </button>

                                    <button
                                        type="submit"
                                        class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
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
</x-layouts.app>
