<nav x-data="{ open: false, dark: document.documentElement.classList.contains('dark') }"
     x-init="window.addEventListener('darkmode-changed', e => dark = e.detail.dark)"
     class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-100 shadow-sm dark:bg-slate-900/80 dark:border-slate-700/60">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center space-x-8">
                <!-- Logo & Brand -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 via-purple-600 to-pink-500 flex items-center justify-center text-white shadow-lg shadow-indigo-200 transition-all duration-300 group-hover:scale-105 group-hover:rotate-3">
                            <svg class="w-5 h-5 stroke-[2.5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7.893a2 2 0 01-1.696 1.977 8.001 8.001 0 11-13.4-.047 2 2 0 01-1.4-1.93 2 2 0 011.8-1.996 8.001 8.001 0 0114.9 2z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 11a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                            </svg>
                        </div>
                        <span class="font-extrabold text-xl tracking-tight bg-gradient-to-r from-indigo-700 to-purple-800 bg-clip-text text-transparent group-hover:from-indigo-600 group-hover:to-purple-700 transition">
                            WashWire
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-1">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium transition duration-200 {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-700 font-semibold shadow-sm dark:bg-indigo-900/40 dark:text-indigo-300' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-slate-100' }}">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z" />
                        </svg>
                        Dashboard
                    </a>

                    <!-- Kasir / Buat Transaksi -->
                    <a href="{{ route('kasir.index') }}" 
                       class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium transition duration-200 {{ request()->routeIs('kasir.*') || request()->routeIs('kasir.index') ? 'bg-indigo-50 text-indigo-700 font-semibold shadow-sm dark:bg-indigo-900/40 dark:text-indigo-300' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-slate-100' }}">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Kasir
                    </a>

                    <!-- Pelacakan -->
                    <a href="{{ route('tracking.index') }}" 
                       class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium transition duration-200 {{ request()->routeIs('tracking.*') || request()->routeIs('tracking.index') ? 'bg-indigo-50 text-indigo-700 font-semibold shadow-sm dark:bg-indigo-900/40 dark:text-indigo-300' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-slate-100' }}">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-2 5h.01M9 16h.01M9 12h.01M12 12h3M12 16h3M12 10h3" />
                        </svg>
                        Pelacakan
                    </a>

                    <!-- Kelola Paket (Admin Only) -->
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('paket.index') }}" 
                           class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium transition duration-200 {{ request()->routeIs('paket.*') ? 'bg-indigo-50 text-indigo-700 font-semibold shadow-sm dark:bg-indigo-900/40 dark:text-indigo-300' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-slate-100' }}">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Kelola Paket
                        </a>
                    @endif
                </div>
            </div>

            <!-- Right side: Dark Mode Toggle + Settings Dropdown -->
            <div class="hidden md:flex md:items-center md:ms-6 gap-2">
                <!-- Role Badge -->
                <span class="me-1 px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider {{ auth()->user()->isAdmin() ? 'bg-gradient-to-r from-purple-100 to-indigo-100 text-indigo-700 border border-indigo-200/50 dark:from-purple-900/40 dark:to-indigo-900/40 dark:text-indigo-300 dark:border-indigo-700/50' : 'bg-emerald-50 text-emerald-700 border border-emerald-200/50 dark:bg-emerald-900/30 dark:text-emerald-400 dark:border-emerald-700/50' }}">
                    {{ auth()->user()->role }}
                </span>

                <!-- Dark Mode Toggle Button -->
                <button
                    id="dark-mode-toggle"
                    onclick="toggleDarkMode()"
                    @click="dark = !dark"
                    title="Toggle dark mode"
                    class="w-9 h-9 flex items-center justify-center rounded-xl border border-slate-200 bg-slate-50 text-slate-500 hover:bg-slate-100 hover:text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-slate-200 transition duration-200 shadow-sm"
                >
                    <!-- Sun icon (shown in dark mode) -->
                    <svg x-show="dark" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M17.657 17.657l-.707-.707M6.343 6.343l-.707-.707M12 5a7 7 0 100 14A7 7 0 0012 5z" />
                    </svg>
                    <!-- Moon icon (shown in light mode) -->
                    <svg x-show="!dark" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-slate-100 text-sm leading-4 font-medium rounded-xl text-slate-600 bg-slate-50 hover:bg-slate-100 hover:text-slate-800 focus:outline-none transition ease-in-out duration-150 dark:border-slate-700 dark:text-slate-300 dark:bg-slate-800 dark:hover:bg-slate-700 dark:hover:text-slate-100">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="rounded-t-lg">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                Profil Saya
                            </span>
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();" class="rounded-b-lg text-red-600 hover:bg-red-50 hover:text-red-700">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                    Keluar
                                </span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger + Mobile Dark Toggle -->
            <div class="-me-2 flex items-center gap-2 md:hidden">
                <!-- Dark Mode Toggle (mobile) -->
                <button
                    onclick="toggleDarkMode()"
                    @click="dark = !dark"
                    title="Toggle dark mode"
                    class="w-9 h-9 flex items-center justify-center rounded-xl border border-slate-200 bg-slate-50 text-slate-500 hover:bg-slate-100 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400 dark:hover:bg-slate-700 transition duration-200"
                >
                    <svg x-show="dark" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M17.657 17.657l-.707-.707M6.343 6.343l-.707-.707M12 5a7 7 0 100 14A7 7 0 0012 5z" />
                    </svg>
                    <svg x-show="!dark" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>

                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-400 hover:text-slate-500 hover:bg-slate-50 focus:outline-none focus:bg-slate-50 focus:text-slate-500 transition duration-150 ease-in-out dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-slate-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-slate-50 border-t border-slate-100 dark:bg-slate-900 dark:border-slate-700/60">
        <div class="pt-2 pb-3 space-y-1 px-3">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="rounded-xl dark:text-slate-300">
                Dashboard
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('kasir.index')" :active="request()->routeIs('kasir.*') || request()->routeIs('kasir.index')" class="rounded-xl dark:text-slate-300">
                Kasir
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('tracking.index')" :active="request()->routeIs('tracking.*') || request()->routeIs('tracking.index')" class="rounded-xl dark:text-slate-300">
                Pelacakan
            </x-responsive-nav-link>
            @if (auth()->user()->isAdmin())
                <x-responsive-nav-link :href="route('paket.index')" :active="request()->routeIs('paket.*')" class="rounded-xl dark:text-slate-300">
                    Kelola Paket
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-slate-200 dark:border-slate-700">
            <div class="px-5 flex items-center justify-between">
                <div>
                    <div class="font-bold text-slate-800 dark:text-slate-100">{{ Auth::user()->name }}</div>
                    <div class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ Auth::user()->email }}</div>
                </div>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-slate-200 text-slate-700 dark:bg-slate-700 dark:text-slate-300">
                    {{ auth()->user()->role }}
                </span>
            </div>

            <div class="mt-3 space-y-1 px-3 pb-3">
                <x-responsive-nav-link :href="route('profile.edit')" class="rounded-xl dark:text-slate-300">
                    Profil Saya
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();" class="rounded-xl text-red-600">
                        Keluar
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
