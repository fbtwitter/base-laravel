@props([
    'label' => '',
    'icon' => '',
    'active' => false,
    'href' => '#',
    'subItems' => null,
])

<li x-data="{ open: false }">
    @if($subItems)
        <button
            type="button"
            @click="open = !open"
            class="flex w-full items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-start text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-hidden dark:bg-neutral-800 dark:text-neutral-200 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 {{ $active ? 'bg-gray-100 dark:bg-neutral-700 dark:text-white' : '' }}"
            :class="{ 'bg-gray-100 dark:bg-neutral-700 dark:text-white': open }"
        >
            {!! $icon !!}
            {{ $label }}
            <svg
                class="ms-auto size-4 text-gray-600"
                :class="{ 'rotate-180': open }"
                style="transition: transform 0.2s;"
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
        </button>

        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="w-full overflow-hidden ps-7 pt-1"
            x-cloak
        >
            <ul class="space-y-1">
                @if(is_array($subItems))
                    @foreach($subItems as $subItem)
                        <x-elements.menu.sub-item
                            :label="$subItem['label']"
                            :subItems="$subItem['items'] ?? []"
                        />
                    @endforeach
                @else
                    {{ $subItems }}
                @endif
            </ul>
        </div>
    @else
        <a
            class="flex w-full items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-hidden dark:bg-neutral-800 dark:text-neutral-200 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 {{ $active ? 'bg-gray-100 dark:bg-neutral-700 dark:text-white' : '' }}"
            href="{{ $href }}"
            wire:navigate
        >
            {!! $icon !!}
            {{ $label }}
        </a>
    @endif
</li>
