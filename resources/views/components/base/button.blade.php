@props(['type' => 'button', 'variant' => 'solid', 'disabled' => false, 'rounded' => 'lg'])

@php
    $roundeds = [
        'sm' => 'rounded-sm',
        'md' => 'rounded-md',
        'lg' => 'rounded-lg',
        'xl' => 'rounded-xl',
        'full' => 'rounded-full',
    ];

    $variants = [
        // Original solid variants
        'gray' => 'bg-gray-800 hover:bg-gray-900 focus:bg-gray-900 dark:bg-white dark:text-neutral-800 dark:hover:bg-gray-100 dark:focus:bg-gray-100',
        'gray-light' => 'bg-gray-500 hover:bg-gray-600 focus:bg-gray-600',
        'teal' => 'bg-teal-500 hover:bg-teal-600 focus:bg-teal-600',
        'blue' => 'bg-blue-600 hover:bg-blue-700 focus:bg-blue-700',
        'red' => 'bg-red-500 hover:bg-red-600 focus:bg-red-600',
        'yellow' => 'bg-yellow-500 hover:bg-yellow-600 focus:bg-yellow-600',
        'white' => 'bg-white text-gray-800 hover:bg-gray-200 focus:bg-gray-200',

        // Blue-based variants
        'solid' => 'bg-blue-600 text-white hover:bg-blue-700 focus:bg-blue-700',
        'outline' => 'border border-gray-200 text-gray-500 hover:border-blue-600 hover:text-blue-600 focus:border-blue-600 focus:text-blue-600 dark:border-neutral-700 dark:text-neutral-400 dark:hover:border-blue-600 dark:hover:text-blue-500 dark:focus:border-blue-600 dark:focus:text-blue-500',
        'ghost' => 'border-transparent text-blue-600 hover:bg-blue-100 hover:text-blue-800 focus:bg-blue-100 focus:text-blue-800 dark:text-blue-500 dark:hover:bg-blue-800/30 dark:hover:text-blue-400 dark:focus:bg-blue-800/30 dark:focus:text-blue-400',
        'soft' => 'border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 focus:bg-blue-200 dark:bg-blue-900 dark:text-blue-400 dark:hover:bg-blue-800 dark:focus:bg-blue-800',
        'white' => 'border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700',
        'link' => 'border-transparent text-blue-600 hover:text-blue-800 focus:text-blue-800 dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400',

        // Outline variants
        'outline-gray-dark' => 'border border-gray-800 text-gray-800 hover:border-gray-500 hover:text-gray-500 focus:border-gray-500 focus:text-gray-500 dark:border-white dark:text-white dark:hover:border-neutral-300 dark:hover:text-neutral-300',
        'outline-gray-light' => 'border border-gray-500 text-gray-500 hover:border-gray-800 hover:text-gray-800 focus:border-gray-800 focus:text-gray-800 dark:border-neutral-400 dark:text-neutral-400 dark:hover:border-neutral-300 dark:hover:text-neutral-300',
        'outline-teal' => 'border border-teal-500 text-teal-500 hover:border-teal-400 hover:text-teal-400 focus:border-teal-400 focus:text-teal-400',
        'outline-blue' => 'border border-blue-600 text-blue-600 hover:border-blue-500 hover:text-blue-500 focus:border-blue-500 focus:text-blue-500 dark:border-blue-500 dark:text-blue-500 dark:hover:border-blue-400 dark:hover:text-blue-400',
        'outline-red' => 'border border-red-500 text-red-500 hover:border-red-400 hover:text-red-400 focus:border-red-400 focus:text-red-400',
        'outline-yellow' => 'border border-yellow-500 text-yellow-500 hover:border-yellow-400 focus:border-yellow-400 focus:text-yellow-400',
        'outline-white' => 'border border-white text-white hover:border-white/70 hover:text-white/70 focus:border-white/70 focus:text-white/70',

        // Subtle/ghost variants
        'subtle-gray-dark' => 'border-transparent text-gray-800 hover:bg-gray-100 focus:bg-gray-100 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700',
        'subtle-gray-light' => 'border-transparent text-gray-500 hover:bg-gray-100 focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800',
        'subtle-teal' => 'border-transparent text-teal-500 hover:bg-teal-100 hover:text-teal-800 focus:bg-teal-100 dark:hover:bg-teal-800/30 dark:hover:text-teal-400 dark:focus:text-teal-400',
        'subtle-blue' => 'border-transparent text-blue-600 hover:bg-blue-100 hover:text-blue-800 focus:bg-blue-100 focus:text-blue-800 dark:text-blue-500 dark:hover:bg-blue-800/30 dark:hover:text-blue-400 dark:focus:bg-blue-800/30 dark:focus:text-blue-400',
        'subtle-red' => 'border-transparent text-red-500 hover:bg-red-100 hover:text-red-800 focus:bg-red-100 dark:hover:bg-red-800/30 dark:hover:text-red-400 dark:focus:bg-red-800/30 dark:focus:text-red-400',
        'subtle-yellow' => 'border-transparent text-yellow-500 hover:bg-yellow-100 hover:text-yellow-800 focus:bg-yellow-100 dark:hover:bg-yellow-800/30 dark:hover:text-yellow-400 dark:focus:bg-yellow-800/30 dark:focus:text-yellow-400',
        'subtle-white' => 'border-transparent text-white hover:bg-gray-100 hover:text-gray-800 focus:bg-gray-100 dark:hover:bg-white/10 dark:hover:text-white dark:focus:bg-white/10 dark:focus:text-white',

        // Filled/soft variants
        'filled-gray-dark' => 'bg-gray-100 text-gray-800 hover:bg-gray-200 focus:bg-gray-200 dark:bg-white/10 dark:text-white dark:hover:bg-white/20 dark:hover:text-white dark:focus:bg-white/20 dark:focus:text-white',
        'filled-gray-light' => 'bg-gray-100 text-gray-500 hover:bg-gray-200 focus:bg-gray-200 dark:bg-white/10 dark:text-neutral-400 dark:hover:bg-white/20 dark:hover:text-neutral-300 dark:focus:bg-white/20 dark:focus:text-neutral-300',
        'filled-teal' => 'bg-teal-100 text-teal-800 hover:bg-teal-200 focus:bg-teal-200 dark:bg-teal-800/30 dark:text-teal-500 dark:hover:bg-teal-800/20 dark:focus:bg-teal-800/20',
        'filled-blue' => 'bg-blue-100 text-blue-800 hover:bg-blue-200 focus:bg-blue-200 dark:bg-blue-800/30 dark:text-blue-400 dark:hover:bg-blue-800/20 dark:focus:bg-blue-800/20',
        'filled-red' => 'bg-red-100 text-red-800 hover:bg-red-200 focus:bg-red-200 dark:bg-red-800/30 dark:text-red-500 dark:hover:bg-red-800/20 dark:focus:bg-red-800/20',
        'filled-yellow' => 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200 focus:bg-yellow-200 dark:bg-yellow-800/30 dark:text-yellow-500 dark:hover:bg-yellow-800/20 dark:focus:bg-yellow-800/20',
        'filled-white' => 'bg-white/10 text-white hover:bg-white/20 focus:bg-white/20',

        // Elevated/white variants
        'elevated-gray-dark' => 'border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700',
        'elevated-gray-light' => 'border border-gray-200 bg-white text-gray-500 shadow-2xs hover:bg-gray-50 focus:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700',
        'elevated-teal' => 'border border-gray-200 bg-white text-teal-500 shadow-2xs hover:bg-gray-50 focus:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700',
        'elevated-blue' => 'border border-gray-200 bg-white text-blue-600 shadow-2xs hover:bg-gray-50 focus:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-800 dark:text-blue-500 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700',
        'elevated-red' => 'border border-gray-200 bg-white text-red-500 shadow-2xs hover:bg-gray-50 focus:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700',
        'elevated-yellow' => 'border border-gray-200 bg-white text-yellow-500 shadow-2xs hover:bg-gray-50 focus:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700',

        // Pill variants
        'pill-solid' => 'bg-blue-600 text-white hover:bg-blue-700 focus:bg-blue-700',
        'pill-elevated' => 'border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:bg-gray-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800',
    ];

    $baseClasses = 'py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium border focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none transition-colors duration-200 ' . ($roundeds[$rounded] ?? $roundeds['lg']);
    $variantClasses = $variants[$variant] ?? $variants['solid'];
@endphp

<button
    {{ $attributes->merge(['type' => $type, 'class' => $baseClasses . ' ' . $variantClasses, 'disabled' => $disabled]) }}
>
    {{ $slot }}
</button>
