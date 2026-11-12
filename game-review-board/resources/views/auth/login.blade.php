<x-layout>

    <div class="max-w-md mx-auto bg-white rounded-lg shadow p-6">

        <h1 class="text-xl font-bold mb-4">Log in to Your Account</h1>


        <form action="{{ route('login') }}" method="POST" class="space-y-3">
        @csrf

            <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email: </label>
            <input id="email" value="{{ old('email') }}" name="email" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('email')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
            </div>

            <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password: </label>
            <input id="password" value="{{ old('password') }}" name="password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('password')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
            </div>

            <button type="submit" class="w-full bg-indigo-700 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Login</button>
        </form>

    </div>


</x-layout>
