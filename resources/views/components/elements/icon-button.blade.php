@props([
    'icon' => null,
    'iconPosition' => 'left',
    'iconSize' => null,
    'iconClass' => '',
    'size' => 'md',
])

@php
    // Auto-calculate icon size based on button size if not explicitly set
    if (! $iconSize) {
        $iconSizes = [
            'sm' => 'h-3 w-3',
            'md' => 'h-4 w-4',
            'lg' => 'h-5 w-5',
            'xl' => 'h-6 w-6',
        ];
        $iconSize = $iconSizes[$size] ?? $iconSizes['md'];
    }
@endphp

<x-base.button {{ $attributes }}>
    @if ($icon && $iconPosition === 'left')
        <x-base.icon :icon-name="$icon" :size="$iconSize" :class="$iconClass" />
    @endif

    {{ $slot }}

    @if ($icon && $iconPosition === 'right')
        <x-base.icon :icon-name="$icon" :size="$iconSize" :class="$iconClass" />
    @endif
</x-base.button>
