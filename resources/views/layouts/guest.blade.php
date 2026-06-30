<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'UiTM Guard') }}</title>

        @include('partials.head-assets')
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-purple-950 via-purple-900 to-indigo-950 min-h-screen">
        <div class="min-h-screen flex flex-col sm:justify-center items-center px-4 py-8 sm:py-0">
            <div class="w-full max-w-md">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>