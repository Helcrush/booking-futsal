<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Arena Futsal') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,900" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-100 text-slate-800 overflow-hidden">

    <!-- Overlay Mobile -->
    <div id="sidebarOverlay"
        class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden">
    </div>

    <div class="flex h-screen w-screen overflow-hidden">

        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col h-full min-w-0 overflow-hidden">

            @include('layouts.navbar')

            <main class="flex-1 p-4 md:p-6 lg:p-8 overflow-y-auto content-start">
                @yield('content')
            </main>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const toggle = document.getElementById('toggleSidebar');

            toggle?.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            });

            overlay?.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            });

        });
    </script>

</body>
</html>