    <x-layout>
        <div class="text-center py-16">
            <h1 class="text-4xl font-bold text-indigo-700">
                Welcome to the Game Review Board
            </h1>
            <p class="text-gray-600 mt-4 max-w-xl mx-auto">
                Discover dishonest, community-written reviews for your favorite games.
            </p>
            <a href="{{ url('/reviews') }}" class="inline-block mt-6 bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700">
                Browse Reviews
            </a>
        </div>
    </x-layout>
