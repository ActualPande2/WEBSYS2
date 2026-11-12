<x-layout>

    <div class="max-w-md mx-auto bg-white rounded-lg shadow p-6">

        <h1 class="text-xl font-bold mb-4">
            Create an Account
        </h1>

        <form method="POST" action="{{ route('register') }}" class="space-y-3">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input id="name" name="name" value="{{ old('name') }}" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('name')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" value="{{ old('email') }}" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('email')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" name="password" value="{{ old('password') }}" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('password')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('password_confirmation')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button class="w-full bg-indigo-700 text-white px-4 py-2 rounded-md hover:bg-indigo-700" type="submit">Register</button>

        </form>
    </div>


</x-layout>
