<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - {{ config('app.name', 'WashWire') }}</title>

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

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-canvas dark:bg-ink text-ink dark:text-canvas">
    <div class="min-h-screen flex flex-col lg:flex-row">
        {{-- Dark Mode Toggle (Pojok Kanan Atas) --}}
        <button
            id="dark-mode-toggle"
            onclick="toggleDarkMode()"
            title="Toggle dark mode"
            class="fixed top-6 right-6 z-50 inline-flex items-center justify-center w-12 h-12 rounded-full border border-hairline bg-canvas text-ink hover:bg-soft-cloud dark:border-stone dark:bg-ink dark:text-canvas dark:hover:bg-charcoal transition-colors">
            <svg class="w-5 h-5 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M17.657 17.657l-.707-.707M6.343 6.343l-.707-.707M12 5a7 7 0 100 14A7 7 0 0012 5z" />
            </svg>
            <svg class="w-5 h-5 block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
            </svg>
        </button>

        {{-- Left Side: Login Form --}}
        <div class="flex-1 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 border-r border-hairline dark:border-stone">
            <div class="w-full max-w-sm space-y-12">
                {{-- Logo / Branding --}}
                <div>
                    <h1 class="font-display uppercase text-[64px] leading-[0.9] text-ink dark:text-canvas tracking-tight">
                        WASH<br>WIRE.
                    </h1>
                    <p class="text-xs font-bold uppercase tracking-widest text-mute dark:text-stone mt-4">Masuk untuk melanjutkan</p>
                </div>

                {{-- Session Status --}}
                @if (session('status'))
                    <div class="border border-success bg-success-bright/10 p-4 text-success flex items-center gap-3 rounded-none">
                        <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        <div class="text-xs font-bold uppercase tracking-widest flex-grow">{{ session('status') }}</div>
                    </div>
                @endif

                {{-- Form Card --}}
                <div class="space-y-8">
                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        {{-- Email Address --}}
                        <div class="space-y-2">
                            <label for="email" class="text-[10px] font-bold uppercase tracking-widest text-ink dark:text-canvas">Email</label>
                            <input id="email"
                                class="flex h-12 w-full rounded-none border border-hairline bg-transparent px-4 py-2 text-base text-ink placeholder:text-mute focus:outline-none focus:ring-0 focus:border-ink dark:border-stone dark:text-canvas dark:placeholder:text-stone transition-colors @error('email') border-sale focus:border-sale @enderror"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="NAMA@EMAIL.COM" />
                            @error('email')
                                <p class="text-[10px] font-bold uppercase tracking-widest text-sale mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="space-y-2">
                            <label for="password" class="text-[10px] font-bold uppercase tracking-widest text-ink dark:text-canvas">Password</label>
                            <input id="password"
                                class="flex h-12 w-full rounded-none border border-hairline bg-transparent px-4 py-2 text-base text-ink placeholder:text-mute focus:outline-none focus:ring-0 focus:border-ink dark:border-stone dark:text-canvas dark:placeholder:text-stone transition-colors @error('password') border-sale focus:border-sale @enderror"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="••••••••" />
                            @error('password')
                                <p class="text-[10px] font-bold uppercase tracking-widest text-sale mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Remember Me & Forgot Password --}}
                        <div class="flex items-center justify-between pt-2">
                            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                                <input id="remember_me"
                                    type="checkbox"
                                    class="rounded-none border-hairline text-ink focus:ring-0 dark:border-stone dark:bg-transparent dark:checked:bg-canvas"
                                    name="remember">
                                <span class="ms-3 text-[10px] font-bold uppercase tracking-widest text-mute group-hover:text-ink dark:text-stone dark:group-hover:text-canvas transition-colors">Ingat saya</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="text-[10px] font-bold uppercase tracking-widest border-b border-ink text-ink hover:text-charcoal dark:border-canvas dark:text-canvas dark:hover:text-stone pb-0.5 transition-colors" href="{{ route('password.request') }}">
                                    Lupa password?
                                </a>
                            @endif
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit" class="w-full inline-flex items-center justify-center whitespace-nowrap rounded-full bg-ink dark:bg-canvas px-8 py-4 text-[11px] font-bold uppercase tracking-widest text-canvas dark:text-ink hover:opacity-80 transition-colors mt-8">
                            MASUK
                        </button>
                    </form>

                    {{-- Register Link --}}
                    <p class="text-center text-[10px] font-bold uppercase tracking-widest text-mute dark:text-stone pt-8 border-t border-hairline dark:border-stone">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="ml-2 border-b border-ink text-ink hover:text-charcoal dark:border-canvas dark:text-canvas dark:hover:text-stone pb-0.5 transition-colors">
                            DAFTAR SEKARANG
                        </a>
                    </p>
                </div>

                {{-- Footer --}}
                <p class="text-center text-[10px] font-bold uppercase tracking-widest text-mute/50 dark:text-stone/50 mt-12">
                    © {{ date('Y') }} WASHWIRE LAUNDRY
                </p>
            </div>
        </div>

        {{-- Right Side: Image --}}
        <div class="hidden lg:flex flex-1 relative bg-ink dark:bg-canvas items-center justify-center p-12">
            <!-- This acts as a graphic replacement for the old purple gradient -->
            <div class="text-canvas dark:text-ink max-w-lg">
                <h2 class="font-display uppercase text-[80px] leading-[0.8] tracking-tight mb-8">BRING<br>THE<br>HEAT.</h2>
                <p class="text-sm font-bold uppercase tracking-widest opacity-80 max-w-sm leading-relaxed">
                    Pantau status cucian Anda secara real-time, kelola transaksi, dan nikmati pengalaman yang lebih baik.
                </p>
            </div>
        </div>
    </div>

    {{-- Dark Mode Toggle Script --}}
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
