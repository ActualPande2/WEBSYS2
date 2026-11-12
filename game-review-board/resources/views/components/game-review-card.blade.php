<div class="bg-white rounded-lg shadowp-4">
    <div class="flex justify-between items-center">
        <h2 class="font-bold text-lg">
            {{ $gameReview->game_title }}
        </h2>
        <span class="text-yellow-500">
            Rating: {{ $gameReview->rating }}/5
        </span>
    </div>

    <p class="text-sm text-gray-600 mt-3">
        Reviewed by: {{ $gameReview->author }}
        &middot;
        {{ $gameReview->created_at->diffForHumans() }}
    </p>
    <p class="text-sm text-gray-600 mt-3">
        {{ $gameReview->review }}
    </p>
    <div class="flex gap-3 text-sm">
        <a href="{{ route('reviews.edit', $gameReview) }}" class="text-indigo-600 hover:underline">Edit</a>
        <form action="{{ route('reviews.destroy', $gameReview) }}" method="POST" onsubmit="return confirm('Delete this review?')">
        @csrf
        @method('DELETE')
        <button class="text-red-600 hover:underline" type="submit">Delete</button>
    </form>
    </div>


</div>


