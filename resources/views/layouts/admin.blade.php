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
</head>

<body class="font-sans antialiased bg-white dark:bg-black">
    @include('layouts.navigation')
    <main>
        <div class="py-12">
            <div class="flex flex-col sm:flex-row gap-4 max-w-7xl mx-auto px-4">
                <div class="max-w-full w-full sm:max-w-[240px] space-y-2">
                    @foreach ($links as $link)
                        <div>
                            <x-link :href="$link['url']">
                                <x-card>
                                    {{ $link['name'] }}
                                </x-card>
                            </x-link>
                        </div>
                    @endforeach
                </div>
                <div class="w-full">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </main>
</body>

</html>
