@props([
    'label' => 'Label',
    'type' => 'text',
    'placeholder' => 'Write here...',
    'forgot' => false,
    'model' => null,           // Dynamic wire:model
    'errorKey' => null,        // Dynamic error key
    'required' => false,       // Optional field
    'id' => null,              // Custom ID
    'name' => null,            // Custom name
    'class' => '',             // Additional classes
])

@php
    // Generate ID if not provided
    $id = $id ?? \Illuminate\Support\Str::slug($label, '_');

    // Use provided model or generate from label
    $model = $model ?? "form." . \Illuminate\Support\Str::lower($id);

    // Use provided error key or generate from model
    $errorKey = $errorKey ?? $model;

    // Determine name attribute
    $name = $name ?? $id;
@endphp

<div class="flex flex-col gap-2 {{ $class }}">
    <div class="flex items-center justify-between">
        <x-atoms.typographies.label for="{{ $id }}">{{ $label }}</x-atoms.typographies.label>

        @if($forgot)
            <x-atoms.typographies.link
                href="{{ route('password.request') }}"
                class="text-sm"
                wire:navigate>
                Forgot password?
            </x-atoms.typographies.link>
        @endif
    </div>

    <x-atoms.forms.input
        :id="$id"
        :type="$type"
        :name="$name"
        wire:model="{{ $model }}"
        :placeholder="$placeholder"
        :required="$required" />

    @error($errorKey)
    <x-atoms.typographies.text class="text-red-600 text-sm">{{ $message }}</x-atoms.typographies.text>
    @enderror
</div>
