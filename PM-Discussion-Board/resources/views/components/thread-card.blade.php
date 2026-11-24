@props(['thread'])

<article class="theatre-thread-card">
    <div class="flex gap-4">
        <div class="theatre-vote-rail" aria-label="Thread voting">
            @if ($thread->trashed())
                <span class="theatre-vote-button" aria-hidden="true">▲</span>
                <span class="theatre-vote-score">{{ $thread->votes_sum_vote_type ?? 0 }}</span>
                <span class="theatre-vote-button" aria-hidden="true">▼</span>
            @else
                @auth
                    <form action="{{ route('threads.votes.store', $thread) }}" method="POST">
                        @csrf
                        <input type="hidden" name="vote_type" value="1">
                        <button type="submit" class="theatre-vote-button theatre-vote-button--up" aria-label="Upvote this discussion" title="Upvote">▲</button>
                    </form>
                    <span class="theatre-vote-score" aria-label="Vote score">{{ $thread->votes_sum_vote_type ?? 0 }}</span>
                    <form action="{{ route('threads.votes.store', $thread) }}" method="POST">
                        @csrf
                        <input type="hidden" name="vote_type" value="-1">
                        <button type="submit" class="theatre-vote-button theatre-vote-button--down" aria-label="Downvote this discussion" title="Downvote">▼</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="theatre-vote-button" aria-label="Sign in to vote" title="Sign in to vote">▲</a>
                    <span class="theatre-vote-score" aria-label="Vote score">{{ $thread->votes_sum_vote_type ?? 0 }}</span>
                    <a href="{{ route('login') }}" class="theatre-vote-button" aria-label="Sign in to vote" title="Sign in to vote">▼</a>
                @endauth
            @endif
        </div>

        <div class="theatre-thread-content">
            <div class="theatre-thread-meta">
                @if ($thread->category)
                    <span class="theatre-chip">{{ $thread->category->name }}</span>
                @endif
                <span>Posted by {{ $thread->user->name }}</span>
                <span aria-hidden="true">·</span>
                <time datetime="{{ $thread->created_at->toIso8601String() }}">{{ $thread->created_at->diffForHumans() }}</time>
                @if ($thread->trashed())
                    <span class="theatre-chip">Archived</span>
                @endif
            </div>

            @if ($thread->trashed())
                <h3 class="theatre-thread-heading theatre-deleted">[deleted]</h3>
                <p class="theatre-thread-copy theatre-deleted">This discussion was removed. Replies remain in the conversation.</p>
            @else
                <h3 class="theatre-thread-heading">
                    <a href="{{ route('threads.show', $thread) }}">{{ $thread->title }}</a>
                </h3>
                <p class="theatre-thread-copy">{{ \Illuminate\Support\Str::limit($thread->content, 280) }}</p>
            @endif

            @if (! $thread->trashed() && $thread->tags->isNotEmpty())
                <ul class="theatre-topic-list" aria-label="Thread topics">
                    @foreach ($thread->tags as $tag)
                        <li class="theatre-chip">
                            {{ $tag->name }}
                            @if ($tag->pivot->is_primary)
                                <span class="sr-only">(primary topic)</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif

            <div class="theatre-thread-footer">
                @if (! $thread->trashed())
                    <a href="{{ route('threads.show', $thread) }}">{{ $thread->replies_count }} {{ \Illuminate\Support\Str::plural('reply', $thread->replies_count) }}</a>
                @else
                    <span>{{ $thread->replies_count }} {{ \Illuminate\Support\Str::plural('reply', $thread->replies_count) }}</span>
                @endif
                <span>{{ $thread->votes_sum_vote_type ?? 0 }} score</span>
            </div>
        </div>
    </div>
</article>
