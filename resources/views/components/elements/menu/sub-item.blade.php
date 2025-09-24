@props([
    'label' => '',
    'subItems' => [],
])

<li x-data="{ open: false }">
    <button
        type="button"
        @click="open = !open"
        class="flex w-full items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-start text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-hidden dark:bg-neutral-800 dark:text-neutral-200 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
    >
        {{ $label }}

        <svg
            class="ms-auto size-4 text-gray-600"
            :class="{ 'hidden': open, 'block': !open }"
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
        >
            <path d="m6 9 6 6 6-6" />
        </svg>
        <svg
            class="ms-auto size-4 text-gray-600"
            :class="{ 'block': open, 'hidden': !open }"
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
        >
            <path d="m18 15-6-6-6 6" />
        </svg>
    </button>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="max-height-0 opacity-0"
        x-transition:enter-end="max-height-[1000px] opacity-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="max-height-[1000px] opacity-100"
        x-transition:leave-end="max-height-0 opacity-0"
        class="w-full overflow-hidden ps-2 pt-1"
    >
        <ul class="space-y-1">
            @foreach($subItems as $item)
                <li>
                    <a
                        class="flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-hidden dark:bg-neutral-800 dark:text-neutral-200 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        href="{{ $item['href'] }}"
                    >
                        {{ $item['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</li>
