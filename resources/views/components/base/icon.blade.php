@props([
    'iconName' => 'home',
    'size' => 'w-4 h-4',
    'class' => '',
])

@php
    $iconPrefix = 'lucide-' . $iconName;

    // Combine size and custom classes more efficiently
    $classes = collect([$size, $class])->filter()->implode(' ');

    // Get extra attributes (excluding our handled props)
    $extraAttributes = $attributes->except(['iconName', 'icon-name', 'size', 'class'])->getAttributes();
@endphp

{{-- Render the SVG with combined classes and extra attributes --}}
@svg($iconPrefix, $classes, $extraAttributes)
