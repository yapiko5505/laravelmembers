<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
        {{-- ここから貼り付けます --}}
            <div class="w-full container mx-auto p-6">
                <div class="w-full flex items-center justify-between">
                   {{-- ロゴ追加--}}
                    <a href ="{{route('top')}}"><img src="{{asset('logo/inko_green.png')}}"></a>
            {{ $slot }}
        </div>
    </body>
</html>
