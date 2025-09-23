@props(['for' => 'label'])

@php
    $baseClass = "block text-sm text-gray-900 dark:text-white"
@endphp

<label {{$attributes->merge(['for' => $for, 'class' => $baseClass])}}>{{$slot}}</label>
