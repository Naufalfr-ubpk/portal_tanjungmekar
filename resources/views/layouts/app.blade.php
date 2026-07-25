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
        
        <!-- CSS SAKTI ANTI BENTROK & ANTI OVERSIZE -->
        <style>
            /* Membatasi tinggi cropper supaya tidak perlu zoom out */
            .cropper-container {
                max-height: 60vh !important; 
            }
            /* Pastikan modal/overlay tidak tertutup navbar */
            [x-show="showCropperModal"], .modal, .cropper-modal {
                z-index: 9999 !important;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            
            <!-- Navbar Z-Index diturunkan ke 30 supaya kalah sama Cropper -->
            <div class="sticky top-0 z-30 w-full">
                @include('layouts.navigation')

                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif
            </div>

            <!-- HILANGIN relative dan z-0 disini, biar modal nembus ke depan -->
            <main>
                {{ $slot }}
            </main>
            
        </div>
    </body>
</html>