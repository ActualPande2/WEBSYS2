<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreThreadRequest;
use App\Http\Requests\UpdateThreadRequest;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Thread;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ThreadController extends Controller
{
    public function index(): View
    {
        $threads = Thread::withTrashed()
            ->with(['user', 'category', 'tags'])
            ->withCount([
                'replies' => function (Builder $query): void {
                    $query->withTrashed();
                },
            ])
            ->withSum('votes', 'vote_type')
            ->latest()
            ->paginate(15);
        $categories = Category::withCount('threads')->orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('threads.index', compact('threads', 'categories', 'tags'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('threads.create', compact('categories', 'tags'));
    }

    public function store(StoreThreadRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $tagSyncData = $this->makeTagSyncData(
            $validated['tags'] ?? [],
            isset($validated['primary_tag_id']) ? (int) $validated['primary_tag_id'] : null,
        );

        unset($validated['tags'], $validated['primary_tag_id']);

        $thread = $request->user()->threads()->create($validated);
        $thread->tags()->sync($tagSyncData);

        return redirect()->route('threads.show', $thread)
            ->with('status', 'Thread created.');
    }

    public function show(Thread $thread): View
    {
        $thread->load(['user', 'category', 'tags']);

        $replies = $thread->replies()
            ->withTrashed()
            ->with([
                'user',
                'parent' => function (Builder $query): void {
                    $query->withTrashed();
                },
            ])
            ->withCount('votes')
            ->oldest()
            ->get();

        return view('threads.show', compact('thread', 'replies'));
    }

    public function edit(Request $request, Thread $thread): View
    {
        $this->ensureThreadOwner($request, $thread);

        $thread->load('tags');
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('threads.edit', compact('thread', 'categories', 'tags'));
    }

    public function update(UpdateThreadRequest $request, Thread $thread): RedirectResponse
    {
        $this->ensureThreadOwner($request, $thread);

        $validated = $request->validated();
        $tagSyncData = $this->makeTagSyncData(
            $validated['tags'] ?? [],
            isset($validated['primary_tag_id']) ? (int) $validated['primary_tag_id'] : null,
        );

        unset($validated['tags'], $validated['primary_tag_id']);

        $thread->update($validated);
        $thread->tags()->sync($tagSyncData);

        return redirect()->route('threads.show', $thread)
            ->with('status', 'Thread updated.');
    }

    public function destroy(Request $request, Thread $thread): RedirectResponse
    {
        $this->ensureThreadOwner($request, $thread);
        $thread->delete();

        return redirect()->route('threads.index')
            ->with('status', 'Thread deleted.');
    }

    /**
     * @param  array<int, int|string>  $tagIds
     * @return array<int, array{is_primary: bool}>
     */
    private function makeTagSyncData(array $tagIds, ?int $primaryTagId): array
    {
        $tagSyncData = [];

        foreach ($tagIds as $tagId) {
            $tagId = (int) $tagId;
            $tagSyncData[$tagId] = ['is_primary' => $tagId === $primaryTagId];
        }

        return $tagSyncData;
    }

    private function ensureThreadOwner(Request $request, Thread $thread): void
    {
        abort_unless((int) $request->user()->getKey() === (int) $thread->user_id, 403);
    }
}
