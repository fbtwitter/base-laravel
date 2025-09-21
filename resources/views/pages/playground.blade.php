<?php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

middleware(['auth', 'verified']);
name('playground');

new class extends Component {
    public function mount()
    {
        info('this component has been loaded');
    }
};
?>

<x-layouts.app>
    @volt('pages.playground')
        <div class="container mx-auto px-4 py-8">
            <div class="card">
                <div class="card-body p-8">
                    <h1 class="mb-4 text-2xl font-bold text-white">Playground</h1>

                    <!-- Converted from Flux button -->
                    <button type="button" class="btn btn-primary" data-pan="playground-button">Hi everyone</button>
                </div>
            </div>
        </div>
    @endvolt
</x-layouts.app>
