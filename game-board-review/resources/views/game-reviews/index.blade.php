<x-layout>
    <form method="POST" action="{{ route('reviews.store') }}" class="bg-white rounded-lg shadow p-4 space-y-3 mb-6">
        @csrf
        <div>
            {{-- Author --}}
            <div>
                <label for="author" class="block text-sm font-medium text-gray-700">
                    Your Name:
                </label>
                <input type="text" id="author" name="author" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('author')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Game Title --}}
            <div>
                <label for="game_title" class="block text-sm font-medium text-gray-700">
                    Game Title:
                </label>
                <input type="text" id="game_title" name="game_title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('game_title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Review --}}
            <div>
                <label for="review" class="block text-sm font-medium text-gray-700">
                    Your Review:
                </label>
                <input type="text" id="review" name="review" value='{{ old('review') }}' class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('review')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Rating --}}
            <div>
                <label for="rating" class="block text-sm font-medium text-gray-700">
                    Your Rating:
                </label>
                <input type="number" id="rating" name="rating" min="1" max="5" value="{{ old('rating') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('rating')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-400">
                Submit Review
            </button>
        </div>
    </form>
    <h1 class="text-2xl font-bold mb-6">
        Game Reviews
    </h1>  
    <div>
        @forelse ($gameReviews as $gameReview)
            <x-game-review-card :gameReview="$gameReview" />
        @empty
            <p class="text-gray-500 text-center">No reviews found. Be the first to review a game!</p>
        @endforelse
    </div>
</x-layout>