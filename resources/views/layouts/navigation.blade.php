<nav x-data="{ open: false, dark: document.documentElement.classList.contains('dark') }"
     x-init="window.addEventListener('darkmode-changed', e => dark = e.detail.dark)"
     class="sticky top-0 z-50 bg-white border-b border-zinc-200 dark:bg-zinc-950 dark:border-zinc-800">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center space-x-8">
                <!-- Logo & Brand -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-md bg-[#9737e3] flex items-center justify-center text-white">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7.893a2 2 0 01-1.696 1.977 8.001 8.001 0 11-13.4-.047 2 2 0 01-1.4-1.93 2 2 0 011.8-1.996 8.001 8.001 0 0114.9 2z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 11a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                            </svg>
                        </div>
                        <span class="font-semibold text-lg text-zinc-900 dark:text-zinc-50">
                            WashWire
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-1">
                    <!-- Dashboard Staff -->
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->routeIs('dashboard') ? 'bg-[#9737e3]/10 text-[#9737e3] dark:bg-[#9737e3]/20' : 'text-zinc-500 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-50' }}">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z" />
                        </svg>
                        Dashboard
                    </a>

                    <!-- Kasir / Buat Transaksi -->
                    <a href="{{ route('kasir.index') }}"
                       class="flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->routeIs('kasir.*') ? 'bg-[#9737e3]/10 text-[#9737e3] dark:bg-[#9737e3]/20' : 'text-zinc-500 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-50' }}">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Kasir
                    </a>

                    <!-- Pelacakan -->
                    <a href="{{ route('tracking.index') }}"
                       class="flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->routeIs('tracking.*') ? 'bg-[#9737e3]/10 text-[#9737e3] dark:bg-[#9737e3]/20' : 'text-zinc-500 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-50' }}">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-2 5h.01M9 16h.01M9 12h.01M12 12h3M12 16h3M12 10h3" />
                        </svg>
                        Pelacakan
                    </a>

                    <!-- Kelola Paket (Admin Only) -->
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('paket.index') }}"
                           class="flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->routeIs('paket.*') ? 'bg-[#9737e3]/10 text-[#9737e3] dark:bg-[#9737e3]/20' : 'text-zinc-500 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-50' }}">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Kelola Paket
                        </a>
                    @endif
                </div>
            </div>

            <!-- Right side: Dark Mode Toggle + Settings Dropdown -->
            <div class="hidden md:flex md:items-center md:ms-6 gap-3">
                <!-- Role Badge -->
                <span class="inline-flex items-center rounded-md border px-2.5 py-0.5 text-sm font-semibold transition-colors
                    {{ auth()->user()->isAdmin() ? 'border-[#9737e3]/20 bg-[#9737e3]/10 text-[#9737e3] dark:border-[#9737e3]/30 dark:bg-[#9737e3]/20' : 'border-zinc-200 bg-white text-zinc-700 dark:border-zinc-700 dark:bg-zinc-950 dark:text-zinc-300' }}">
                    {{ auth()->user()->role }}
                </span>

                <!-- Dark Mode Toggle Button -->
                <button
                    id="dark-mode-toggle"
                    onclick="toggleDarkMode()"
                    @click="dark = !dark"
                    title="Toggle dark mode"
                    class="inline-flex items-center justify-center w-9 h-9 rounded-md border border-zinc-200 bg-white text-zinc-500 hover:bg-zinc-100 hover:text-zinc-900 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-50 transition-colors"
                >
                    <!-- Sun icon (shown in dark mode) -->
                    <svg x-show="dark" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M17.657 17.657l-.707-.707M6.343 6.343l-.707-.707M12 5a7 7 0 100 14A7 7 0 0012 5z" />
                    </svg>
                    <!-- Moon icon (shown in light mode) -->
                    <svg x-show="!dark" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>

                <x-dropdown align="right" width="48" class="mt-2 rounded-lg border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-950 shadow-lg p-1">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-100 hover:text-zinc-900 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-300 dark:hover:bg-zinc-800 dark:hover:text-zinc-50 transition-colors">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="rounded-md text-sm text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                Profil Saya
                            </span>
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();" class="rounded-md text-sm text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-950/50">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
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
                    class="inline-flex items-center justify-center w-9 h-9 rounded-md border border-zinc-200 bg-white text-zinc-500 hover:bg-zinc-100 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-400 dark:hover:bg-zinc-800 transition-colors"
                >
                    <svg x-show="dark" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M17.657 17.657l-.707-.707M6.343 6.343l-.707-.707M12 5a7 7 0 100 14A7 7 0 0012 5z" />
                    </svg>
                    <svg x-show="!dark" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>

                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-zinc-400 hover:text-zinc-500 hover:bg-zinc-100 focus:outline-none focus:bg-zinc-100 focus:text-zinc-500 transition duration-150 ease-in-out dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-white dark:bg-zinc-950 border-t border-zinc-200 dark:border-zinc-800">
        <div class="pt-2 pb-3 space-y-1 px-3">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="rounded-md text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-[#9737e3]/10 text-[#9737e3] dark:bg-[#9737e3]/20' : 'text-zinc-500 hover:bg-zinc-100 dark:text-zinc-400 dark:hover:bg-zinc-800' }}">
                Dashboard
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('kasir.index')" :active="request()->routeIs('kasir.*')" class="rounded-md text-sm font-medium {{ request()->routeIs('kasir.*') ? 'bg-[#9737e3]/10 text-[#9737e3] dark:bg-[#9737e3]/20' : 'text-zinc-500 hover:bg-zinc-100 dark:text-zinc-400 dark:hover:bg-zinc-800' }}">
                Kasir
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('tracking.index')" :active="request()->routeIs('tracking.*')" class="rounded-md text-sm font-medium {{ request()->routeIs('tracking.*') ? 'bg-[#9737e3]/10 text-[#9737e3] dark:bg-[#9737e3]/20' : 'text-zinc-500 hover:bg-zinc-100 dark:text-zinc-400 dark:hover:bg-zinc-800' }}">
                Pelacakan
            </x-responsive-nav-link>
            @if (auth()->user()->isAdmin())
                <x-responsive-nav-link :href="route('paket.index')" :active="request()->routeIs('paket.*')" class="rounded-md text-sm font-medium {{ request()->routeIs('paket.*') ? 'bg-[#9737e3]/10 text-[#9737e3] dark:bg-[#9737e3]/20' : 'text-zinc-500 hover:bg-zinc-100 dark:text-zinc-400 dark:hover:bg-zinc-800' }}">
                    Kelola Paket
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-zinc-200 dark:border-zinc-800">
            <div class="px-4 flex items-center justify-between">
                <div>
                    <div class="font-semibold text-base text-zinc-900 dark:text-zinc-50">{{ Auth::user()->name }}</div>
                    <div class="text-sm text-zinc-500 dark:text-zinc-400">{{ Auth::user()->email }}</div>
                </div>
                <span class="inline-flex items-center rounded-md border px-2.5 py-0.5 text-sm font-semibold transition-colors
                    {{ auth()->user()->isAdmin() ? 'border-[#9737e3]/20 bg-[#9737e3]/10 text-[#9737e3] dark:border-[#9737e3]/30 dark:bg-[#9737e3]/20' : 'border-zinc-200 bg-white text-zinc-700 dark:border-zinc-700 dark:bg-zinc-950 dark:text-zinc-300' }}">
                    {{ auth()->user()->role }}
                </span>
            </div>

            <div class="mt-3 space-y-1 px-3 pb-3">
                <x-responsive-nav-link :href="route('profile.edit')" class="rounded-md text-sm font-medium text-zinc-500 hover:bg-zinc-100 dark:text-zinc-400 dark:hover:bg-zinc-800">
                    Profil Saya
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();" class="rounded-md text-sm font-medium text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-950/50">
                        Keluar
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
