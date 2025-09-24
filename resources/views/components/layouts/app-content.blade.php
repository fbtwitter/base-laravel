<div
    class="relative min-h-screen transition-all duration-300"
    :class="{ 'sm:ms-64': sidebarOpen }"
>
    <div class="bg-dark" x-show="sidebarOpen" @click="sidebarOpen = false"></div>
    <x-modules.nav-header />
    <main class="relative flex h-full items-center justify-center">
        {{ $slot }}
    </main>
</div>
