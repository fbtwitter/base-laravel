@props([
    'label' => 'Remember me',
    'model' => null,
    'name' => null,
    'id' => null,
    'checked' => false,
    'disabled' => false,
    'required' => false,
    'class' => '',
    'inputClass' => '',
    'labelClass' => '',
])

@php
    // Generate ID if not provided
    $id = $id ?? \Illuminate\Support\Str::slug($label, '_');

    // Use provided model or generate from label
    $model = $model ?? 'form.' . \Illuminate\Support\Str::lower($id);

    // Use provided name or generate from ID
    $name = $name ?? $id;
@endphp

<div class="{{ $class }} flex">
    <x-base.forms.checkbox
        :id="$id"
        :checked="$checked"
        :disabled="$disabled"
        wire:model="{{ $model }}"
        :required="$required"
        :name="$name"
    />

    {{--    <label for="hs-default-checkbox" class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Remember Me</label>--}}
    <x-base.typographies.label
        for="{{ $id }}"
        class="ms-3  !text-gray-500 dark:!text-neutral-400 {{ $labelClass }}"
    >
        {{ $label }}
    </x-base.typographies.label>
</div>
