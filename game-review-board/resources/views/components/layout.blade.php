
<!--
    main.max-w-2xl.mx-auto.py-8.px-4

    CREATES MAIN WITH CLASS
    <main class="max-w-2xl mx-auto py-8 px-4">

-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Game Review Board</title>
</head>
<body>

    <div class="flex items-center gap-4 w-full border-b border-gray-200">
        <nav class="bg-white border-b border-gray-400 px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-6 w-full">
                <a href="{{ url('/') }}" class="text-xl font-bold text-indigo-600">Game Review Board</a>
                <a href="{{ url('/about') }}" class="text-sm text-gray-600 hover:underline">About</a>
                <a href="{{ url('/reviews') }}" class="text-sm text-gray-600 hover:underline">Reviews</a>
                @auth
                <span class="text-sm text-gray-600">
                    Signed in as {{ auth()->user()->name }}
                </span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-sm text-red-600 hover:underline">Sign Out</button>
                </form>
                @else
                <a href="{{ url('/login') }}" class="text-sm text-gray-600 hover:underline">Log in</a>
                <a href="{{ url('/register') }}" class="text-sm text-indigo-600 hover:underline">Register</a>
                @endauth
            </div>
        </nav>
    </div>


    <main class="max-w-2xl mx-auto py-8 px-4">
            {{ $slot }}
    </main>

</body>
</html>
