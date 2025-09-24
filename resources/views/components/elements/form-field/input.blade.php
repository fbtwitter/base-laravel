@props([
    'label' => 'Label',
    'type' => 'text',
    'placeholder' => 'Write here...',
    'forgot' => false,
    'model' => null,
    'errorKey' => null,
    'required' => false,
    'id' => null,
    'name' => null,
    'class' => '',
])

@php
    // Generate ID if not provided
    $id ??= \Illuminate\Support\Str::slug($label, '_');

    // Use provided model or generate from label
    $model ??= 'form.' . \Illuminate\Support\Str::lower($id);

    // Use provided error key or generate from model
    $errorKey ??= $model;

    // Determine name attribute
    $name ??= $id;
@endphp

<div class="{{ $class }} flex flex-col gap-2">
    <div class="flex items-center justify-between">
        <x-base.typographies.label for="{{ $id }}" class="leading-6 font-medium">
            {{ $label }}
        </x-base.typographies.label>

        @if ($forgot)
            <x-base.typographies.link href="{{ route('password.request') }}" class="text-sm" wire:navigate>
                Forgot password?
            </x-base.typographies.link>
        @endif
    </div>

    <x-base.forms.input
        :id="$id"
        :type="$type"
        :name="$name"
        wire:model="{{ $model }}"
        :placeholder="$placeholder"
        :required="$required"
    />

    @error($errorKey)
        <x-base.typographies.text class="text-sm text-red-600">{{ $message }}</x-base.typographies.text>
    @enderror
</div>
