<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/logo.svg') }}" />
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script>
            (function () {
                const theme = localStorage.getItem("theme");
                if (theme === "dark") {
                    document.documentElement.classList.add("dark");
                }
            })();
        </script>

    </head>
    <body class="font-sans antialiased min-h-full">
        @include('layouts.employees.employee-session-message')
        <!-- Page Content -->
        <main class="flex-col w-full lg:flex lg:flex-row h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.employees.employee-navigation')
            <div class="flex w-full  px-3 bg-center bg-gray-300 dark:bg-[url('img/cielostellato.PNG')] overflow-auto bg-cover">
                {{ $slot }}
            </div>
        </main>
        
        <script src="{{ asset('assets/script.js') }}" ></script>
    </body>
</html>
