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
    
    <!-- Highcharts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
</head>
<body class="font-sans antialiased bg-white min-h-screen flex">
        @auth
            @include('layouts.sidebar')
        @endauth

        <div class="flex-1 flex flex-col">
            @include('layouts.navigation')

            <div class="flex-1">
                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white dark:bg-gray-800 shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Flash Messages -->
                @if (session('success'))
                    <div class="max-w-7xl mx-auto mt-4 px-4 sm:px-6 lg:px-8">
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="max-w-7xl mx-auto mt-4 px-4 sm:px-6 lg:px-8">
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded" role="alert">
                            <p>{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Page Content -->
                <main class="py-6">
                    {{ $slot }}
                </main>
            </div>
        </div>
        @include('sweetalert::alert')
        @stack('scripts')
</body>
</html>