<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'WashWire Laundry') }}</title>

    @fonts

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-white text-gray-800 min-h-screen flex items-center justify-center p-6">
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
        <p class="text-gray-500 text-sm mb-8">
            Sistem Manajemen Laundry Internal
        </p>

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100 mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">Selamat Datang</h2>
            <p class="text-sm text-gray-600 mb-6">
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
        <p class="text-xs text-gray-400">
            © {{ date('Y') }} WashWire Laundry. Internal use only.
        </p>
    </div>
</body>
</html>
