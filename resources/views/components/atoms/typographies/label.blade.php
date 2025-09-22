@props(['for' => 'label'])

@php
    $baseClass = "block text-sm font-medium leading-6 text-gray-900  dark:text-white"
@endphp

<label {{$attributes->merge(['for' => $for, 'class' => $baseClass])}}>{{$slot}}</label>
