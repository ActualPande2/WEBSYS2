<x-layout>
    <h1 class="text-2xl font-bold mb-6">Edit Review</h1>
    <form action="{{ route('reviews.update', $gameReview) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Game Title:</label>
            <input type="text" name="game_title" id="game_title" value="{{ old('game_title', $gameReview->game_title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('game_title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="review" class="block text-sm font-medium text-gray-700">Your Rating</label>
            <textarea name="review" id="review" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                {{ old('review', $gameReview->review) }}
            </textarea>
            @error("review")
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
            <input type="text" id="rating" name="rating" value="{{ old('rating', $gameReview->rating) }}" class="mt-1 block w-24 rounded-md border-gray-300 shadow-sm">
            @error("rating")
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Save Changes</button>
    </form>
</x-layout>