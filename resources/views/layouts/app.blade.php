<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'HealthSync'))</title>
    <!-- Styles with Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#e6f7f7',
                            100: '#ccefef',
                            200: '#99dfdf',
                            300: '#66cfcf',
                            400: '#33bfbf',
                            500: '#00aeae',
                            600: '#00a0a0',
                            700: '#008080',
                            800: '#006060',
                            900: '#004040',
                        },
                        secondary: {
                            500: '#0891b2', /* cyan-600 */
                        }
                    },
                    animation: {
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    }
                }
            }
        }
    </script>

    <!-- Additional styles -->
    @stack('styles')
</head>

<body class="bg-gray-50 font-sans min-h-screen flex flex-col">
    <!-- Header -->
    @include('layouts.partials.header')

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('layouts.partials.footer')

    <!-- Additional scripts -->
    @stack('scripts')
</body>

</html>