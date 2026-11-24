<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#12090d">
        <title>{{ $title ?? config('app.name', 'Project Moon Discussion Board') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="theatre-body">
        <div class="theatre-shell">
            <a href="#main-content" class="theatre-skip">Skip to content</a>

            <x-navbar />

            <main id="main-content" class="theatre-main">
                @if (session('status'))
                    <p class="theatre-alert" role="status">{{ session('status') }}</p>
                @endif

                {{ $slot }}
            </main>

            <x-footer />
        </div>
    </body>
</html>
