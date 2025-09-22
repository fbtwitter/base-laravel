@props(["id" => "#", 'checked' => false, "disabled" => false, 'required' => false])

@php
    $baseClass = "shrink-0 mt-0.5 border-gray-200 rounded-sm text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
@endphp


<input type="checkbox" {{$attributes->merge(['id' => $id, 'class' => $baseClass])}} />

{{--:name="$name"--}}
{{--wire:model="{{ $model }}"--}}
{{--:checked="$checked"--}}
{{--:disabled="$disabled"--}}
{{--:required="$required"--}}
{{--class="shrink-0 mt-0.5 border-gray-200 rounded-sm text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800 {{ $inputClass }}"--}}
