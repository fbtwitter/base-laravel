@props(['type' => 'text', 'id' => '#', 'placeholder' => 'Write here...', 'disabled' => false, 'required' => false])

@php
    $baseClass =
        'block w-full rounded-lg border-gray-200 px-4 py-2.5 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 sm:py-3 sm:text-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600';
@endphp

<input
    {{ $attributes->merge(['type' => $type, 'id' => $id, 'class' => $baseClass, 'placeholder' => $placeholder]) }}
/>
