<button
    type="button"
    @click="
        darkMode = !darkMode;
        document.documentElement.classList.toggle('dark', darkMode);
        localStorage.setItem('darkMode', darkMode);
    "
    class="inline-flex items-center gap-x-2 rounded-full border border-gray-200 bg-white px-3 py-2 text-sm text-gray-800 shadow-lg transition-colors duration-200 hover:bg-gray-50 dark:border-gray-700 dark:bg-slate-900 dark:text-white dark:hover:bg-slate-800"
    :aria-label="darkMode ? 'Switch to light mode' : 'Switch to dark mode'"
>
    <svg
        x-show="!darkMode"
        class="size-4"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        stroke-width="2"
        aria-hidden="true"
    >
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z" />
    </svg>
    <svg
        x-show="darkMode"
        class="size-4"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        stroke-width="2"
        aria-hidden="true"
    >
        <circle cx="12" cy="12" r="4" />
        <path d="M12 2v2" />
        <path d="M12 20v2" />
        <path d="m4.93 4.93 1.41 1.41" />
        <path d="m17.66 17.66 1.41 1.41" />
        <path d="M2 12h2" />
        <path d="M20 12h2" />
        <path d="m6.34 17.66-1.41-1.41" />
        <path d="m19.07 4.93-1.41-1.41" />
    </svg>
    <span x-text="darkMode ? 'Light' : 'Dark'"></span>
</button>
