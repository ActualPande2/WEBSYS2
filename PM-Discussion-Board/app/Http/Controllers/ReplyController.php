<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplyRequest;
use App\Http\Requests\UpdateReplyRequest;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(StoreReplyRequest $request, Thread $thread): RedirectResponse
    {
        $validated = $request->validated();

        $request->user()->replies()->create([
            'thread_id' => $thread->getKey(),
            'parent_id' => $validated['parent_id'] ?? null,
            'content' => $validated['content'],
        ]);

        return redirect()->route('threads.show', $thread)
            ->with('status', 'Reply posted.');
    }

    public function update(UpdateReplyRequest $request, Thread $thread, Reply $reply): RedirectResponse
    {
        $this->ensureReplyOwner($request, $reply);
        $reply->update($request->validated());

        return redirect()->route('threads.show', $thread)
            ->with('status', 'Reply updated.');
    }

    public function destroy(Request $request, Thread $thread, Reply $reply): RedirectResponse
    {
        $this->ensureReplyOwner($request, $reply);
        $reply->delete();

        return redirect()->route('threads.show', $thread)
            ->with('status', 'Reply deleted.');
    }

    private function ensureReplyOwner(Request $request, Reply $reply): void
    {
        abort_unless((int) $request->user()->getKey() === (int) $reply->user_id, 403);
    }
}
