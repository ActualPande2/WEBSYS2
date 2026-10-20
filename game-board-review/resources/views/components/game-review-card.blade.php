<div class="bg-white rounded-lg shadowp-4">
    <div class="flex justify-between items-center">
        <h2 class="font-bold text-lg">
            {{ $gameReview->game_title }}
        </h2>
        <span class="text-yellow-500">
            Rating: {{ $gameReview->rating }}/5
        </span>
    </div>

    <p class="text-sm text-gray-400 mt-3">
        Reviewed By: {{ $gameReview->author }} &middot; {{ $gameReview->created_at->diffForHumans() }}
    </p>
    
    <div class="flex gap-3 text-sm">
        <a href="{{ route('reviews.edit', $gameReview) }}" class="text-indigo-600 hover:underline">Edit</a>
        <form method="POST" action="{{ route('reviews.destroy', $gameReview) }}" onsubmit="return confirm('Delete this review?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red hover:underline">Delete</button>
        </form>
    </div>
</div>
