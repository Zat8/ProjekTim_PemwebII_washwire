<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-white dark:bg-slate-900 py-12 px-4">
        <div class="w-full max-w-md">
            <!-- Logo / Branding -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-[#9737e3] rounded-2xl shadow-lg mb-4">
                    <!-- Ikon Mesin Cuci -->
                    <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2zm3 4a1 1 0 11-2 0 1 1 0 012 0zm10 0a1 1 0 11-2 0 1 1 0 012 0zM7 12a5 5 0 1110 0 5 5 0 01-10 0z"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-[#9737e3]">
                    WashWire Laundry
                </h1>
                <p class="text-gray-500 dark:text-slate-400 text-sm mt-2">Masuk ke akun Anda untuk melanjutkan</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white dark:bg-slate-800 dark:border dark:border-slate-700 rounded-2xl shadow-xl p-8 border border-gray-200">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email"
                            class="block mt-1 w-full rounded-lg border-gray-300 focus:border-[#9737e3] focus:ring-[#9737e3] transition"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="nama@email.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password"
                            class="block mt-1 w-full rounded-lg border-gray-300 focus:border-[#9737e3] focus:ring-[#9737e3] transition"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me"
                                type="checkbox"
                                class="rounded border-gray-300 text-[#9737e3] shadow-sm focus:ring-[#9737e3]"
                                name="remember">
                            <span class="ms-2 text-sm text-gray-600 dark:text-slate-400">{{ __('Ingat saya') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-[#9737e3] hover:text-[#7a2db8] font-medium transition" href="{{ route('password.request') }}">
                                {{ __('Lupa password?') }}
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <x-primary-button class="w-full justify-center py-3 rounded-lg bg-[#9737e3] hover:bg-[#7a2db8] shadow-md font-semibold">
                        {{ __('Masuk') }}
                    </x-primary-button>
                </form>
            </div>

            <p class="text-center text-sm text-gray-500 dark:text-slate-400 mt-6">
                © {{ date('Y') }} WashWire Laundry. All rights reserved.
            </p>
        </div>
    </div>
</x-guest-layout>
