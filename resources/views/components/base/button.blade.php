@props([
    'type' => 'button',
    'variant' => 'solid',
    'color' => 'primary',
    'size' => 'md',
    'rounded' => 'lg',
    'disabled' => false,
    'href' => null,
    'target' => null,
])

@php
    // Size configurations based on your examples
    $sizes = [
        'sm' => 'py-2 px-3 text-sm',           // Small button
        'md' => 'py-3 px-4 text-sm',           // Default button
        'lg' => 'p-4 sm:p-5 text-sm',          // Large button with responsive padding
        'xl' => 'py-4 px-8 text-base',         // Extra large
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
        $sizes[$size] ?? $sizes['md'],
        $roundedClasses[$rounded] ?? $roundedClasses['lg'],
    ])->filter()->implode(' ');

    // Generate variant classes based on color and variant
    $variantClasses = match($variant) {
        'solid' => match($color) {
            'primary' => 'bg-blue-600 text-white border-blue-600 hover:bg-blue-700 focus:ring-blue-500',
            'secondary' => 'bg-gray-600 text-white border-gray-600 hover:bg-gray-700 focus:ring-gray-500',
            'success' => 'bg-green-600 text-white border-green-600 hover:bg-green-700 focus:ring-green-500',
            'danger' => 'bg-red-600 text-white border-red-600 hover:bg-red-700 focus:ring-red-500',
            'warning' => 'bg-yellow-600 text-white border-yellow-600 hover:bg-yellow-700 focus:ring-yellow-500',
            'info' => 'bg-cyan-600 text-white border-cyan-600 hover:bg-cyan-700 focus:ring-cyan-500',
            default => 'bg-blue-600 text-white border-blue-600 hover:bg-blue-700 focus:ring-blue-500',
        },

        'outline' => match($color) {
            'primary' => 'bg-transparent text-blue-600 border-blue-600 hover:bg-blue-50 focus:ring-blue-500',
            'secondary' => 'bg-transparent text-gray-600 border-gray-600 hover:bg-gray-50 focus:ring-gray-500',
            'success' => 'bg-transparent text-green-600 border-green-600 hover:bg-green-50 focus:ring-green-500',
            'danger' => 'bg-transparent text-red-600 border-red-600 hover:bg-red-50 focus:ring-red-500',
            'warning' => 'bg-transparent text-yellow-600 border-yellow-600 hover:bg-yellow-50 focus:ring-yellow-500',
            'info' => 'bg-transparent text-cyan-600 border-cyan-600 hover:bg-cyan-50 focus:ring-cyan-500',
            default => 'bg-transparent text-blue-600 border-blue-600 hover:bg-blue-50 focus:ring-blue-500',
        },

        'ghost' => match($color) {
            'primary' => 'bg-transparent text-blue-600 border-transparent hover:bg-blue-50 focus:ring-blue-500',
            'secondary' => 'bg-transparent text-gray-600 border-transparent hover:bg-gray-50 focus:ring-gray-500',
            'success' => 'bg-transparent text-green-600 border-transparent hover:bg-green-50 focus:ring-green-500',
            'danger' => 'bg-transparent text-red-600 border-transparent hover:bg-red-50 focus:ring-red-500',
            'warning' => 'bg-transparent text-yellow-600 border-transparent hover:bg-yellow-50 focus:ring-yellow-500',
            'info' => 'bg-transparent text-cyan-600 border-transparent hover:bg-cyan-50 focus:ring-cyan-500',
            default => 'bg-transparent text-blue-600 border-transparent hover:bg-blue-50 focus:ring-blue-500',
        },

        'soft' => match($color) {
            'primary' => 'bg-blue-100 text-blue-900 border-transparent hover:bg-blue-200 focus:ring-blue-500',
            'secondary' => 'bg-gray-100 text-gray-900 border-transparent hover:bg-gray-200 focus:ring-gray-500',
            'success' => 'bg-green-100 text-green-900 border-transparent hover:bg-green-200 focus:ring-green-500',
            'danger' => 'bg-red-100 text-red-900 border-transparent hover:bg-red-200 focus:ring-red-500',
            'warning' => 'bg-yellow-100 text-yellow-900 border-transparent hover:bg-yellow-200 focus:ring-yellow-500',
            'info' => 'bg-cyan-100 text-cyan-900 border-transparent hover:bg-cyan-200 focus:ring-cyan-500',
            default => 'bg-blue-100 text-blue-900 border-transparent hover:bg-blue-200 focus:ring-blue-500',
        },

        default => 'bg-blue-600 text-white border-blue-600 hover:bg-blue-700 focus:ring-blue-500',
    };

    $finalClasses = $baseClasses . ' ' . $variantClasses;

    // Determine which element to render and prepare attributes
    $tag = !empty($href) ? 'a' : 'button';

    if ($tag === 'a') {
        // Link-specific attributes
        $elementAttributes = $attributes->merge([
            'href' => $href,
            'class' => $finalClasses,
            'target' => $target,
        ])->except(['type', 'disabled']); // Remove button-only attributes

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
