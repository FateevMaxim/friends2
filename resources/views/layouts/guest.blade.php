<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!– PWA  –>

        <meta name=”theme-color” content=”#6777ef”/>

        <link rel=”apple-touch-icon” href=”{{ asset('/favicons/512x512.png') }}”>

        <link rel=”manifest” href=”{{ asset('/manifest.json') }}”>
        <title>{{ config('app.name', 'Cargo') }}</title>
        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/jquery.inputmask.bundle.min.js') }}"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans mt-6 text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0" id="main_block">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>
            @if(\Illuminate\Support\Facades\Route::is('login') || \Illuminate\Support\Facades\Route::is('stock') || \Illuminate\Support\Facades\Route::is('admin'))
                <div class="pt-7"><h3 style="color:#13386c; font-size: 1.5em; font-weight: bold;">Вход в систему</h3></div>
            @endif

            @if(\Illuminate\Support\Facades\Route::is('register'))
                <div class="pt-7"><h3 style="color:#13386c; font-size: 1.5em; font-weight: bold;">Регистрация</h3></div>
            @endif

            <div class="w-full sm:max-w-md mt-2 px-6 py-4 bg-white overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function(){
            $('.phone').inputmask('+79999999999');
        });
    </script>
    <script src=”{{ asset('/sw.js') }}”>

    </script>

    <script>

        if (!navigator.serviceWorker.controller) {

            navigator.serviceWorker.register("/sw.js").

            then(function (reg) {

                console.log("Service worker has been registered for scope: " + reg.scope);

            });

        }

    </script>
</html>
