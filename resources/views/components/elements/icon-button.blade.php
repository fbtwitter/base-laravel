@props([
    'icon' => null,
    'iconPosition' => 'left',
    'iconSize' => null,
    'iconClass' => '',
    'size' => 'md',
])

@php
    // Auto-calculate icon size based on button size if not explicitly set
    if (!$iconSize) {
        $iconSizes = [
            'sm' => 'w-3 h-3',
            'md' => 'w-4 h-4',
            'lg' => 'w-5 h-5',
            'xl' => 'w-6 h-6',
        ];
        $iconSize = $iconSizes[$size] ?? $iconSizes['md'];
    }
@endphp

<x-base.button {{ $attributes }}>
    @if($icon && $iconPosition === 'left')
        <x-base.icon
            :icon-name="$icon"
            :size="$iconSize"
            :class="$iconClass"
        />
    @endif

    {{ $slot }}

    @if($icon && $iconPosition === 'right')
        <x-base.icon
            :icon-name="$icon"
            :size="$iconSize"
            :class="$iconClass"
        />
    @endif
</x-base.button>
