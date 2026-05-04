<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Spektrum Multi Grafika - Auth</title>

        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @stack('css')

        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
            .auth-bg {
                background-image: linear-gradient(rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.8)), url("{{ asset('images/background.png') }}");
                background-size: cover;
                background-position: center;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center py-12 px-4 sm:px-6 lg:px-8 auth-bg">
            <div class="w-full {{ $width ?? 'max-w-md' }} mt-6 bg-white/10 dark:bg-slate-900/40 backdrop-blur-xl shadow-2xl rounded-[2.5rem] border border-white/20 dark:border-white/10 transition-all duration-500 overflow-visible">
                <div class="px-6 py-8 sm:px-10 sm:py-12">
                    <div class="flex justify-center mb-10">
                        <a href="/">
                            <img src="{{ asset('images/logo.png') }}" class="h-16 w-auto object-contain transition-transform hover:scale-105" alt="Logo">
                        </a>
                    </div>

                    {{ $slot }}
                </div>
            </div>
            
            <div class="mt-6">
                <a href="/" class="text-slate-400 hover:text-white text-sm transition-colors flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>

        @stack('scripts')
    </body>
</html>