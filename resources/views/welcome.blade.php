<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'WashWire Laundry') }}</title>

    <!-- Dark mode: apply before paint to avoid flash -->
    <script>
        (function(){
            var k='washwire-dark-mode';
            var s=localStorage.getItem(k);
            if(s==='dark'||(s===null&&window.matchMedia('(prefers-color-scheme:dark)').matches)){
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    @fonts

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-white dark:bg-slate-900 text-gray-800 dark:text-slate-100 min-h-screen flex items-center justify-center p-6 transition-colors duration-200">

    <!-- Dark Mode Toggle Button (top-right corner) -->
    <div x-data="{ dark: document.documentElement.classList.contains('dark') }"
         x-init="window.addEventListener('darkmode-changed', e => dark = e.detail.dark)"
         class="fixed top-4 right-4 z-50">
        <button
            onclick="toggleDarkMode()"
            @click="dark = !dark"
            title="Toggle dark mode"
            class="w-10 h-10 flex items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 hover:bg-slate-100 hover:text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-slate-200 transition duration-200 shadow-md"
        >
            <svg x-show="dark" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M17.657 17.657l-.707-.707M6.343 6.343l-.707-.707M12 5a7 7 0 100 14A7 7 0 0012 5z" />
            </svg>
            <svg x-show="!dark" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
            </svg>
        </button>
    </div>

    <div class="w-full max-w-md text-center">
        <!-- Logo Mesin Cuci -->
        <div class="inline-flex items-center justify-center w-20 h-20 bg-[#9737e3] rounded-2xl shadow-lg mb-6">
            <svg class="w-11 h-11 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2zm3 4a1 1 0 11-2 0 1 1 0 012 0zm10 0a1 1 0 11-2 0 1 1 0 012 0zM7 12a5 5 0 1110 0 5 5 0 01-10 0z"/>
            </svg>
        </div>

        <!-- Judul -->
        <h1 class="text-3xl font-bold text-[#9737e3] mb-2">
            WashWire Laundry
        </h1>
        <p class="text-gray-500 dark:text-slate-400 text-sm mb-8">
            Sistem Manajemen Laundry Internal
        </p>

        <!-- Card -->
        <div class="bg-white dark:bg-slate-800 dark:border dark:border-slate-700 rounded-2xl shadow-lg p-8 border border-gray-100 mb-6">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-slate-100 mb-2">Selamat Datang</h2>
            <p class="text-sm text-gray-600 dark:text-slate-400 mb-6">
                Silakan masuk untuk mengakses dashboard dan mengelola transaksi laundry.
            </p>

            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="block w-full py-3 px-6 bg-[#9737e3] hover:bg-[#7a2db8] text-white font-semibold rounded-lg shadow-md transition">
                        Buka Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="block w-full py-3 px-6 bg-[#9737e3] hover:bg-[#7a2db8] text-white font-semibold rounded-lg shadow-md transition">
                        Masuk
                    </a>
                @endauth
            @endif
        </div>

        <!-- Footer -->
        <p class="text-xs text-gray-400 dark:text-slate-500">
            © {{ date('Y') }} WashWire Laundry. Internal use only.
        </p>
    </div>
</body>
</html>
