<?php

namespace App\Http\Controllers;

use App\Http\Requests\CastVoteRequest;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Http\RedirectResponse;

class ReplyVoteController extends Controller
{
    public function store(CastVoteRequest $request, Thread $thread, Reply $reply): RedirectResponse
    {
        abort_unless((int) $reply->thread_id === (int) $thread->getKey(), 404);

        $request->user()->replyVotes()->updateOrCreate(
            ['reply_id' => $reply->getKey()],
            ['vote_type' => $request->validated('vote_type')],
        );

        return back()->with('status', 'Vote saved.');
    }
}
