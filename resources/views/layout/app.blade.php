<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        @livewireStyles
    </head>
    <body>
        <div class="min-h-screen bg-gray-100">
            {{ $slot }}
        </div>
        @livewireScripts
    </body>
</html>