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
    $model = $model ?? "form." . \Illuminate\Support\Str::lower($id);

    // Use provided name or generate from ID
    $name = $name ?? $id;
@endphp

<div class="flex items-center {{ $class }}">
    <x-atoms.forms.checkbox :id="$id" :checked="$checked"
                            :disabled="$disabled"
                            wire:model="{{ $model }}"
                            :required="$required" :name="$name" />


    <x-atoms.typographies.label
        for="{{ $id }}"
        class="font-normal text-sm text-gray-500 ms-3 dark:text-neutral-400 {{ $labelClass }}"
    >
        {{ $label }}
    </x-atoms.typographies.label>
</div>
