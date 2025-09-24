<x-layouts.template>
    <div x-data="{ sidebarOpen: true }">
        <x-modules.sidebar />
        <x-layouts.app-content>
            {{ $slot }}
        </x-layouts.app-content>
    </div>
</x-layouts.template>
