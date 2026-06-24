<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Register - {{ config('app.name', 'WashWire Laundry') }}</title>

    <script>
        (function(){
            var k='washwire-dark-mode';
            var s=localStorage.getItem(k);
            if(s==='dark'||(s===null&&window.matchMedia('(prefers-color-scheme:dark)').matches)){
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white dark:bg-zinc-950 text-zinc-900 dark:text-zinc-50">
    <div class="min-h-screen flex flex-col lg:flex-row">
        {{-- Dark Mode Toggle --}}
        <button
            id="dark-mode-toggle"
            onclick="toggleDarkMode()"
            title="Toggle dark mode"
            class="fixed top-4 right-4 z-50 inline-flex items-center justify-center w-10 h-10 rounded-md border border-zinc-200 bg-white text-zinc-500 hover:bg-zinc-100 hover:text-zinc-900 dark:border-zinc-800 dark:bg-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-50 transition-colors shadow-sm">
            <svg class="w-5 h-5 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M17.657 17.657l-.707-.707M6.343 6.343l-.707-.707M12 5a7 7 0 100 14A7 7 0 0012 5z" />
            </svg>
            <svg class="w-5 h-5 block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
            </svg>
        </button>

        {{-- Left Side: Register Form --}}
        <div class="flex-1 flex items-center justify-center bg-white dark:bg-zinc-950 py-12 px-4 sm:px-6 lg:px-8">
            <div class="w-full max-w-md space-y-8">
                {{-- Logo / Branding --}}
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-14 h-14 bg-[#b45ef7] rounded-lg mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2zm3 4a1 1 0 11-2 0 1 1 0 012 0zm10 0a1 1 0 11-2 0 1 1 0 012 0zM7 12a5 5 0 1110 0 5 5 0 01-10 0z"/>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-50 tracking-tight">
                        Buat Akun Baru
                    </h1>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-2">Daftar untuk mulai menggunakan WashWire</p>
                </div>

                {{-- Form --}}
                <div class="space-y-6">
                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf

                        {{-- Name --}}
                        <div class="space-y-2">
                            <label for="name" class="text-sm font-medium text-zinc-900 dark:text-zinc-50">Nama Lengkap</label>
                            <input id="name"
                                class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm text-zinc-900 placeholder:text-zinc-400 hover:border-zinc-300 focus:outline-none focus:ring-2 focus:ring-[#b45ef7]/20 focus:border-[#b45ef7] dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-50 dark:placeholder:text-zinc-500 dark:hover:border-zinc-700 transition-colors"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                autocomplete="name"
                                placeholder="John Doe" />
                            @error('name')
                                <p class="text-sm font-medium text-red-500 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="space-y-2">
                            <label for="email" class="text-sm font-medium text-zinc-900 dark:text-zinc-50">Email</label>
                            <input id="email"
                                class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm text-zinc-900 placeholder:text-zinc-400 hover:border-zinc-300 focus:outline-none focus:ring-2 focus:ring-[#b45ef7]/20 focus:border-[#b45ef7] dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-50 dark:placeholder:text-zinc-500 dark:hover:border-zinc-700 transition-colors"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="username"
                                placeholder="nama@email.com" />
                            @error('email')
                                <p class="text-sm font-medium text-red-500 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="space-y-2">
                            <label for="password" class="text-sm font-medium text-zinc-900 dark:text-zinc-50">Password</label>
                            <input id="password"
                                class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm text-zinc-900 placeholder:text-zinc-400 hover:border-zinc-300 focus:outline-none focus:ring-2 focus:ring-[#b45ef7]/20 focus:border-[#b45ef7] dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-50 dark:placeholder:text-zinc-500 dark:hover:border-zinc-700 transition-colors"
                                type="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                placeholder="Minimal 8 karakter" />
                            @error('password')
                                <p class="text-sm font-medium text-red-500 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="space-y-2">
                            <label for="password_confirmation" class="text-sm font-medium text-zinc-900 dark:text-zinc-50">Konfirmasi Password</label>
                            <input id="password_confirmation"
                                class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm text-zinc-900 placeholder:text-zinc-400 hover:border-zinc-300 focus:outline-none focus:ring-2 focus:ring-[#b45ef7]/20 focus:border-[#b45ef7] dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-50 dark:placeholder:text-zinc-500 dark:hover:border-zinc-700 transition-colors"
                                type="password"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                placeholder="Ulangi password" />
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit" class="inline-flex items-center justify-center whitespace-nowrap rounded-md bg-[#b45ef7] w-full px-4 py-2.5 text-sm font-medium text-white hover:bg-[#a04de0] focus:outline-none focus:ring-2 focus:ring-[#b45ef7]/40 focus:ring-offset-2 dark:focus:ring-offset-zinc-950 transition-colors">
                            Daftar
                        </button>
                    </form>

                    {{-- Login Link --}}
                    <p class="text-center text-sm text-zinc-500 dark:text-zinc-400">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-medium text-[#b45ef7] hover:text-[#933bd6] transition-colors">
                            Masuk di sini
                        </a>
                    </p>
                </div>

                {{-- Footer --}}
                <p class="text-center text-xs text-zinc-400 dark:text-zinc-500">
                    © {{ date('Y') }} WashWire Laundry. All rights reserved.
                </p>
            </div>
        </div>

        {{-- Right Side: Image --}}
        <div class="hidden lg:flex flex-1 relative bg-zinc-100 dark:bg-zinc-900">
            <img src="{{ asset('images/login-illustration.jpg') }}"
                 alt="WashWire Laundry"
                 class="absolute inset-0 w-full h-full object-cover"
                 onerror="this.style.display='none'">

            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent dark:from-black/80 dark:via-black/40"></div>

            <div class="absolute bottom-8 left-8 right-8 text-white">
                <h2 class="text-2xl font-semibold tracking-tight mb-2">Bergabung dengan WashWire</h2>
                <p class="text-sm text-white/80 max-w-md">Nikmati kemudahan melacak cucian, riwayat transaksi, dan notifikasi real-time langsung di genggaman Anda.</p>
            </div>
        </div>
    </div>

    <script>
        function toggleDarkMode() {
            const html = document.documentElement;
            html.classList.toggle('dark');
            const isDark = html.classList.contains('dark');
            localStorage.setItem('washwire-dark-mode', isDark ? 'dark' : 'light');
        }
    </script>
</body>
</html>
