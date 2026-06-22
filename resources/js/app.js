
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// ─── Dark Mode ────────────────────────────────────────────────────────────────
(function () {
    const DARK_KEY = 'washwire-dark-mode';
    const html = document.documentElement;

    // Apply saved preference, or fall back to OS preference
    function applyTheme() {
        const saved = localStorage.getItem(DARK_KEY);
        if (saved === 'dark' || (saved === null && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
        }
    }

    // Toggle and persist
    window.toggleDarkMode = function () {
        const isDark = html.classList.toggle('dark');
        localStorage.setItem(DARK_KEY, isDark ? 'dark' : 'light');
        window.dispatchEvent(new CustomEvent('darkmode-changed', { detail: { dark: isDark } }));
    };

    // Expose current state
    window.isDarkMode = function () {
        return html.classList.contains('dark');
    };

    // Apply immediately to avoid flash
    applyTheme();
    // Re-apply after DOM ready (covers SSR / Livewire)
    document.addEventListener('DOMContentLoaded', applyTheme);
})();
