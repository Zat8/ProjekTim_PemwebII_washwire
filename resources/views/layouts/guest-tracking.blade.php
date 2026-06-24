<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Lacak Cucian — {{ config('app.name', 'WashWire Laundry') }}</title>
        <meta name="description" content="Lacak status cucian laundry Anda secara real-time. Masukkan nomor invoice untuk melihat progress pengerjaan.">

        <!-- Dark mode: apply before paint to avoid flash -->
        <script>
            (function(){
                var k='washwire-dark-mode';
                var s=localStorage.getItem(k);
                if(s==='dark'||(s===null&&window.matchMedia('(prefers-color-scheme:dark)').matches)){
                    document.documentElement.classList.add('dark');
                }
            })();

            function toggleDarkMode(){
                var k='washwire-dark-mode';
                var html=document.documentElement;
                if(html.classList.contains('dark')){
                    html.classList.remove('dark');
                    localStorage.setItem(k,'light');
                }else{
                    html.classList.add('dark');
                    localStorage.setItem(k,'dark');
                }
                window.dispatchEvent(new CustomEvent('darkmode-changed',{detail:{dark:html.classList.contains('dark')}}));
            }
        </script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-canvas text-ink dark:bg-ink dark:text-canvas min-h-screen">
        {{ $slot }}
        @livewireScripts
    </body>
</html>
