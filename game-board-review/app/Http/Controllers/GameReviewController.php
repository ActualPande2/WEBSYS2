<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\GameReview;

class GameReviewController extends Controller
{
    public function index(): View
    {
        return view('game-reviews.index',
            [
                'gameReviews' => GameReview::latest()->get(),
                
            ]
        );
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'author' => ['required', 'string', 'max:255'],
            'game_title' => ['required', 'string', 'max:255'],
            'review' => ['required', 'string'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
        ]);

        $gameReview = new GameReview($validated);
        $gameReview->author = $validated['author'];
        $gameReview->save();
        
        return redirect()->route('reviews.index');
    }

    public function edit(GameReview $gameReview): View
    {
        return view('game-reviews.edit', [
            'gameReview' => $gameReview,
        ]);
    }

    public function update(Request $request, GameReview $gameReview): RedirectResponse
    {
        $validated = $request->validate([
            'game_title' => ['required', 'string', 'max:255'],
            'review' => ['required', 'string', 'max:1000'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
        ]);

        $gameReview->update($validated);

        return redirect()->route('reviews.index');
    }

    public function destroy(GameReview $gameReview): RedirectResponse
    {
        $gameReview->delete();

        return redirect()->route('reviews.index');
    }
}
