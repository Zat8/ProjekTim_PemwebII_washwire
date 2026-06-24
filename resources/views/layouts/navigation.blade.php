<nav x-data="{ open: false, dark: document.documentElement.classList.contains('dark') }"
     x-init="window.addEventListener('darkmode-changed', e => dark = e.detail.dark)"
     class="sticky top-0 z-50 bg-canvas border-b border-hairline dark:bg-ink dark:border-stone">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center space-x-8">
                <!-- Logo & Brand -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-none bg-ink flex items-center justify-center text-canvas dark:bg-canvas dark:text-ink">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7.893a2 2 0 01-1.696 1.977 8.001 8.001 0 11-13.4-.047 2 2 0 01-1.4-1.93 2 2 0 011.8-1.996 8.001 8.001 0 0114.9 2z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 11a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                            </svg>
                        </div>
                        <span class="font-bold text-lg text-ink dark:text-canvas tracking-tight uppercase">
                            WashWire
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-6 h-16 ml-6">
                    <!-- Dashboard Staff -->
                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors h-full {{ request()->routeIs('dashboard') ? 'border-ink text-ink dark:border-canvas dark:text-canvas' : 'border-transparent text-charcoal hover:text-ink dark:text-stone dark:hover:text-canvas' }}">
                        Dashboard
                    </a>

                    <!-- Kasir / Buat Transaksi -->
                    <a href="{{ route('kasir.index') }}"
                       class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors h-full {{ request()->routeIs('kasir.*') ? 'border-ink text-ink dark:border-canvas dark:text-canvas' : 'border-transparent text-charcoal hover:text-ink dark:text-stone dark:hover:text-canvas' }}">
                        Kasir
                    </a>

                    <!-- Pelacakan -->
                    <a href="{{ route('tracking.index') }}"
                       class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors h-full {{ request()->routeIs('tracking.*') ? 'border-ink text-ink dark:border-canvas dark:text-canvas' : 'border-transparent text-charcoal hover:text-ink dark:text-stone dark:hover:text-canvas' }}">
                        Pelacakan
                    </a>

                    <!-- Kelola Paket (Admin Only) -->
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('paket.index') }}"
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors h-full {{ request()->routeIs('paket.*') ? 'border-ink text-ink dark:border-canvas dark:text-canvas' : 'border-transparent text-charcoal hover:text-ink dark:text-stone dark:hover:text-canvas' }}">
                            Kelola Paket
                        </a>
                    @endif
                </div>
            </div>

            <!-- Right side: Dark Mode Toggle + Settings Dropdown -->
            <div class="hidden md:flex md:items-center md:ms-6 gap-3">
                <!-- Role Badge -->
                <span class="inline-flex items-center rounded-none border border-ink bg-canvas px-2.5 py-0.5 text-xs font-medium uppercase tracking-widest text-ink dark:border-canvas dark:bg-ink dark:text-canvas">
                    {{ auth()->user()->role }}
                </span>

                <!-- Dark Mode Toggle Button -->
                <button
                    id="dark-mode-toggle"
                    onclick="toggleDarkMode()"
                    @click="dark = !dark"
                    title="Toggle dark mode"
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-soft-cloud text-ink hover:bg-hairline-soft dark:bg-charcoal dark:text-canvas dark:hover:bg-ash transition-colors"
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

                <x-dropdown align="right" width="48" class="mt-2 rounded-none border border-hairline dark:border-stone bg-canvas dark:bg-ink shadow-none p-1">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 rounded-full bg-soft-cloud dark:bg-charcoal px-4 py-2 text-sm font-medium text-ink dark:text-canvas hover:bg-hairline-soft dark:hover:bg-ash transition-colors">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="rounded-none text-sm text-ink dark:text-canvas hover:bg-soft-cloud dark:hover:bg-charcoal">
                            <span class="flex items-center gap-2">
                                Profil Saya
                            </span>
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();" class="rounded-none text-sm text-sale hover:bg-soft-cloud dark:hover:bg-charcoal">
                                <span class="flex items-center gap-2">
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
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-soft-cloud text-ink hover:bg-hairline-soft dark:bg-charcoal dark:text-canvas dark:hover:bg-ash transition-colors"
                >
                    <svg x-show="dark" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M17.657 17.657l-.707-.707M6.343 6.343l-.707-.707M12 5a7 7 0 100 14A7 7 0 0012 5z" />
                    </svg>
                    <svg x-show="!dark" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>

                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-full text-ink hover:bg-soft-cloud focus:outline-none dark:text-canvas dark:hover:bg-charcoal transition-colors">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-canvas dark:bg-ink border-t border-hairline dark:border-stone">
        <div class="pt-2 pb-3 space-y-1 px-3">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="rounded-none text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-ink text-canvas dark:bg-canvas dark:text-ink' : 'text-ink hover:bg-soft-cloud dark:text-canvas dark:hover:bg-charcoal' }}">
                Dashboard
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('kasir.index')" :active="request()->routeIs('kasir.*')" class="rounded-none text-sm font-medium {{ request()->routeIs('kasir.*') ? 'bg-ink text-canvas dark:bg-canvas dark:text-ink' : 'text-ink hover:bg-soft-cloud dark:text-canvas dark:hover:bg-charcoal' }}">
                Kasir
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('tracking.index')" :active="request()->routeIs('tracking.*')" class="rounded-none text-sm font-medium {{ request()->routeIs('tracking.*') ? 'bg-ink text-canvas dark:bg-canvas dark:text-ink' : 'text-ink hover:bg-soft-cloud dark:text-canvas dark:hover:bg-charcoal' }}">
                Pelacakan
            </x-responsive-nav-link>
            @if (auth()->user()->isAdmin())
                <x-responsive-nav-link :href="route('paket.index')" :active="request()->routeIs('paket.*')" class="rounded-none text-sm font-medium {{ request()->routeIs('paket.*') ? 'bg-ink text-canvas dark:bg-canvas dark:text-ink' : 'text-ink hover:bg-soft-cloud dark:text-canvas dark:hover:bg-charcoal' }}">
                    Kelola Paket
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-hairline dark:border-stone">
            <div class="px-4 flex items-center justify-between">
                <div>
                    <div class="font-bold text-base text-ink dark:text-canvas">{{ Auth::user()->name }}</div>
                    <div class="text-sm text-charcoal dark:text-stone">{{ Auth::user()->email }}</div>
                </div>
                <span class="inline-flex items-center rounded-none border border-ink bg-canvas px-2.5 py-0.5 text-xs font-medium uppercase tracking-widest text-ink dark:border-canvas dark:bg-ink dark:text-canvas">
                    {{ auth()->user()->role }}
                </span>
            </div>

            <div class="mt-3 space-y-1 px-3 pb-3">
                <x-responsive-nav-link :href="route('profile.edit')" class="rounded-none text-sm font-medium text-charcoal hover:bg-soft-cloud hover:text-ink dark:text-stone dark:hover:bg-charcoal dark:hover:text-canvas">
                    Profil Saya
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();" class="rounded-none text-sm font-medium text-sale hover:bg-soft-cloud dark:hover:bg-charcoal">
                        Keluar
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
