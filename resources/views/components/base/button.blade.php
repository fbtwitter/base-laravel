@props([
    'type' => 'button',
    'variant' => 'solid',
    'color' => 'primary',
    'size' => 'md',
    'rounded' => 'lg',
    'disabled' => false,
    'href' => null,
    'target' => null,
    'fullWidth' => null,
])

@php
    // Size configurations based on your examples
    $sizes = [
        'sm' => 'px-3 py-2 text-sm', // Small button
        'md' => 'px-4 py-3 text-sm', // Default button
        'lg' => 'p-4 text-sm sm:p-5', // Large button with responsive padding
        'xl' => 'px-8 py-4 text-base', // Extra large
    ];

    // Rounded configurations
    $roundedClasses = [
        'none' => '',
        'sm' => 'rounded-sm',
        'md' => 'rounded-md',
        'lg' => 'rounded-lg',
        'xl' => 'rounded-xl',
        'full' => 'rounded-full',
    ];

    // Base classes - same for both button and link
    $baseClasses = collect([
        'inline-flex items-center justify-center gap-x-2',
        'font-medium border transition-all duration-200',
        'focus:outline-none focus:ring-2 focus:ring-offset-2',
        'text-center no-underline', // Added for links
        $disabled ? 'opacity-50 cursor-not-allowed pointer-events-none' : '',
        $fullWidth ? 'w-full' : '',
        $sizes[$size] ?? $sizes['md'],
        $roundedClasses[$rounded] ?? $roundedClasses['lg'],
    ])
        ->filter()
        ->implode(' ');

    // Generate variant classes based on color and variant
    $variantClasses = match ($variant) {
        'solid' => match ($color) {
            'primary' => 'border-blue-600 bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500',
            'secondary' => 'border-gray-600 bg-gray-600 text-white hover:bg-gray-700 focus:ring-gray-500',
            'success' => 'border-green-600 bg-green-600 text-white hover:bg-green-700 focus:ring-green-500',
            'danger' => 'border-red-600 bg-red-600 text-white hover:bg-red-700 focus:ring-red-500',
            'warning' => 'border-yellow-600 bg-yellow-600 text-white hover:bg-yellow-700 focus:ring-yellow-500',
            'info' => 'border-cyan-600 bg-cyan-600 text-white hover:bg-cyan-700 focus:ring-cyan-500',
            default => 'border-blue-600 bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500',
        },

        'outline' => match ($color) {
            'primary' => 'border-blue-600 bg-transparent text-blue-600 hover:bg-blue-50 focus:ring-blue-500',
            'secondary' => 'border-gray-600 bg-transparent text-gray-600 hover:bg-gray-50 focus:ring-gray-500',
            'success' => 'border-green-600 bg-transparent text-green-600 hover:bg-green-50 focus:ring-green-500',
            'danger' => 'border-red-600 bg-transparent text-red-600 hover:bg-red-50 focus:ring-red-500',
            'warning' => 'border-yellow-600 bg-transparent text-yellow-600 hover:bg-yellow-50 focus:ring-yellow-500',
            'info' => 'border-cyan-600 bg-transparent text-cyan-600 hover:bg-cyan-50 focus:ring-cyan-500',
            default => 'border-blue-600 bg-transparent text-blue-600 hover:bg-blue-50 focus:ring-blue-500',
        },

        'ghost' => match ($color) {
            'primary' => 'border-transparent bg-transparent text-blue-600 hover:bg-blue-50 focus:ring-blue-500',
            'secondary' => 'border-transparent bg-transparent text-gray-600 hover:bg-gray-50 focus:ring-gray-500',
            'success' => 'border-transparent bg-transparent text-green-600 hover:bg-green-50 focus:ring-green-500',
            'danger' => 'border-transparent bg-transparent text-red-600 hover:bg-red-50 focus:ring-red-500',
            'warning' => 'border-transparent bg-transparent text-yellow-600 hover:bg-yellow-50 focus:ring-yellow-500',
            'info' => 'border-transparent bg-transparent text-cyan-600 hover:bg-cyan-50 focus:ring-cyan-500',
            default => 'border-transparent bg-transparent text-blue-600 hover:bg-blue-50 focus:ring-blue-500',
        },

        'soft' => match ($color) {
            'primary' => 'border-transparent bg-blue-100 text-blue-900 hover:bg-blue-200 focus:ring-blue-500',
            'secondary' => 'border-transparent bg-gray-100 text-gray-900 hover:bg-gray-200 focus:ring-gray-500',
            'success' => 'border-transparent bg-green-100 text-green-900 hover:bg-green-200 focus:ring-green-500',
            'danger' => 'border-transparent bg-red-100 text-red-900 hover:bg-red-200 focus:ring-red-500',
            'warning' => 'border-transparent bg-yellow-100 text-yellow-900 hover:bg-yellow-200 focus:ring-yellow-500',
            'info' => 'border-transparent bg-cyan-100 text-cyan-900 hover:bg-cyan-200 focus:ring-cyan-500',
            default => 'border-transparent bg-blue-100 text-blue-900 hover:bg-blue-200 focus:ring-blue-500',
        },

        'white' => match ($color) {
            'primary' => 'border-gray-200 bg-white text-blue-600 shadow-2xs hover:bg-gray-50 focus:bg-gray-50 focus:outline-hidden disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-800 dark:text-blue-500 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700',
            'secondary' => 'border-gray-200 bg-white text-gray-500 shadow-2xs hover:bg-gray-50 focus:bg-gray-50 focus:outline-hidden disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700',
            'success' => 'border-gray-200 bg-white text-teal-500 shadow-2xs hover:bg-gray-50 focus:bg-gray-50 focus:outline-hidden disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-800 dark:text-teal-500 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700',
            'danger' => 'border-gray-200 bg-white text-red-500 shadow-2xs hover:bg-gray-50 focus:bg-gray-50 focus:outline-hidden disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-800 dark:text-red-500 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700',
            'warning' => 'border-gray-200 bg-white text-yellow-500 shadow-2xs hover:bg-gray-50 focus:bg-gray-50 focus:outline-hidden disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-800 dark:text-yellow-500 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700',
            'info' => 'border-gray-200 bg-white text-cyan-500 shadow-2xs hover:bg-gray-50 focus:bg-gray-50 focus:outline-hidden disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-800 dark:text-cyan-500 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700',
            default => 'border-gray-200 bg-white text-blue-600 shadow-2xs hover:bg-gray-50 focus:bg-gray-50 focus:outline-hidden disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-800 dark:text-blue-500 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700',
        },

        default => 'border-blue-600 bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500',
    };

    $finalClasses = $baseClasses . ' ' . $variantClasses;

    // Determine which element to render and prepare attributes
    $tag = ! empty($href) ? 'a' : 'button';

    if ($tag === 'a') {
        // Link-specific attributes
        $elementAttributes = $attributes
            ->merge([
                'href' => $href,
                'class' => $finalClasses,
                'target' => $target,
            ])
            ->except(['type', 'disabled']); // Remove button-only attributes

        // Handle disabled state for links
        if ($disabled) {
            $elementAttributes = $elementAttributes->merge([
                'aria-disabled' => 'true',
                'tabindex' => '-1',
            ]);
        }
    } else {
        // Button-specific attributes
        $elementAttributes = $attributes->merge([
            'type' => $type,
            'class' => $finalClasses,
            'disabled' => $disabled,
        ]);
    }
@endphp

<{{ $tag }} {{ $elementAttributes }}>
    {{ $slot }}
</{{ $tag }}>
