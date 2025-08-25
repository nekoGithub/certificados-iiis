@props(['breadcrumbs' => []])
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

    {{-- <!-- Toastr CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/toastr/css/toastr.min.css') }}"> --}}

    {{-- <!-- Toastr JS -->
    <script src="{{ asset('vendor/toastr/js/toastr.min.js') }}"></script> --}}

    {{-- sweetalert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://kit.fontawesome.com/ef0f5ea3a4.js" crossorigin="anonymous"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

</head>

<body class="font-sans antialiased bg-white dark:bg-gray-800" x-data="{
    siderbarOpen: false
}"
    :class="{
        'overflow-hidden': siderbarOpen
    }">

    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 z-20 sm:hidden" style="display: none;" x-show="siderbarOpen"
        x-on:click="siderbarOpen = false"></div>
    {{-- Este eso la plantilla dasboard --}}

    @include('layouts.partials.admin.navigation')

    @include('layouts.partials.admin.siderbar')

    <div class="p-4 sm:ml-64">
        <div class="mt-14">
            <div class="flex justify-between items-center">
                @include('layouts.partials.admin.breadcrumb')
                @isset($action)
                    <div>
                        {{ $action }}
                    </div>
                @endisset
            </div>
            <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 ">
                {{ $slot }}
            </div>
        </div>
    </div>
    {{-- Fin de la plantilla --}}

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0"></script>

    @stack('js')
    <script>
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
        const themeToggleBtn = document.getElementById('theme-toggle');

        if (localStorage.getItem('color-theme') === 'dark' ||
            (!localStorage.getItem('color-theme') &&
                window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        themeToggleBtn.addEventListener('click', function() {
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
            
            if (typeof actualizarColorTextosGrafico === 'function') {
                setTimeout(actualizarColorTextosGrafico, 100);
            }
        });
    </script>
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>

</body>

</html>
