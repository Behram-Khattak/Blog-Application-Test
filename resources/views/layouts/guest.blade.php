<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="{{ asset('assets/vendor/ckeditor5/build/ckeditor.js') }}"></script>
    </head>
    <body class="font-sans text-gray-900 antialiased flex flex-col min-h-screen">
        <header>
            <x-frontend-header />
        </header>

        <main class="py-8">
            {{ $slot }}
        </main>

        <footer class="dark:bg-gray-800 mt-auto">
            <x-frontend-footer />
        </footer>

        {{ $scripts }}
    </body>
</html>
