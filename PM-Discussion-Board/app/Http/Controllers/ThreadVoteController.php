<?php

namespace App\Http\Controllers;

use App\Http\Requests\CastVoteRequest;
use App\Models\Thread;
use Illuminate\Http\RedirectResponse;

class ThreadVoteController extends Controller
{
    public function store(CastVoteRequest $request, Thread $thread): RedirectResponse
    {
        $request->user()->threadVotes()->updateOrCreate(
            ['thread_id' => $thread->getKey()],
            ['vote_type' => $request->validated('vote_type')],
        );

        return back()->with('status', 'Vote saved.');
    }
}
