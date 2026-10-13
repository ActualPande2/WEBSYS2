<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Game Review Board</title>
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    </head>
    <body class="flex item-center gap-4">

        <nav class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-6">
                <a href="{{ url('/') }}" class="text-xl font-bold text-indigo-600">Game Review Board</a>
                <a href="{{ url('/about') }}" class="text-sm text-gray-600 hover:underline">About</a>
                <a href="{{ url('/reviews') }}" class="text-sm text-gray-600 hover:underline">Reviews</a>
            </div>

            <div class="flex items-center gap-4">
                @auth
                <span class="text-sm text-gray-600">
                    Signed in as {{ auth()->user()->name }}
                </span>

                <form method="POST" action="{{route('logout')}}">
                    @csrf
                    <button class="text-sm text-red-600 hover:underline">
                        Logout
                    </button>
                </form>
                
                @else
                <a href="" class="text-sm text-gray-600 hover:underline">Login</a>
                <a href="" class="text-sm text-indigo-600 hover:underline">Register</a>
                @endauth
            </div>
        </nav>

        <main class="max-w-2xl mx-auto py-8 px-4">
            {{ $slot }}
        </main>
    </body>
</html>