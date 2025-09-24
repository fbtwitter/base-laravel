@props(['href' => '#'])

@php
    $baseClass = "text-blue-600 hover:text-blue-500 decoration-2 hover:underline hover:underline-offset-2 focus:outline-hidden focus:underline
         focus:underline-offset-2 opacity-90";
@endphp

<p>
    <a {{ $attributes->merge(['href' => $href, 'class' => $baseClass]) }}>
        {{ $slot }}
    </a>
</p>
