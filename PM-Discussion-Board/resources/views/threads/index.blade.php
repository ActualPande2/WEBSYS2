<x-layout title="Discussions">
    <section class="theatre-marquee" aria-labelledby="theatre-heading">
        <div class="theatre-marquee__ticket" aria-hidden="true">
            Now showing
            <strong>Community no. 01</strong>
        </div>

        <div class="theatre-marquee__content">
            <p class="theatre-kicker">Project Moon community · open theatre</p>
            <h1 id="theatre-heading" class="theatre-marquee__title">
                When the curtain rises,<br>
                <em>the stories begin.</em>
            </h1>
            <p class="theatre-marquee__description">
                Take your seat among fellow fans. Share theories, revisit the scenes, and keep the conversation going.
            </p>

            <div class="theatre-marquee__actions">
                @auth
                    <a href="{{ route('threads.create') }}" class="theatre-action">Open a discussion</a>
                @else
                    <a href="{{ route('register') }}" class="theatre-action">Join the audience</a>
                    <a href="{{ route('login') }}" class="theatre-action theatre-action--ghost">Sign in</a>
                @endauth
            </div>
        </div>
    </section>

    <div class="theatre-content-grid">
        <section aria-labelledby="latest-discussions-heading" class="min-w-0">
            <div class="theatre-section-heading">
                <div>
                    <h2 id="latest-discussions-heading" class="theatre-section-title">Now on stage</h2>
                    <p class="theatre-section-subtitle">The latest conversations from the community.</p>
                </div>
                <span class="theatre-count">{{ $threads->total() }} {{ \Illuminate\Support\Str::plural('discussion', $threads->total()) }}</span>
            </div>

            <div class="theatre-feed-list">
                @forelse ($threads as $thread)
                    <x-thread-card :thread="$thread" />
                @empty
                    <div class="theatre-empty-state">
                        <p class="theatre-kicker">The house is open</p>
                        <h3 class="theatre-empty-state__title mt-3">The stage is waiting for its first story.</h3>
                        <p class="theatre-empty-state__copy">Start a conversation about the moments and worlds that stayed with you.</p>
                        @auth
                            <a href="{{ route('threads.create') }}" class="theatre-action">Post the first discussion</a>
                        @else
                            <a href="{{ route('register') }}" class="theatre-action">Take the first seat</a>
                        @endauth
                    </div>
                @endforelse
            </div>

            @if ($threads->hasPages())
                <nav class="mt-6" aria-label="Discussion pages">
                    {{ $threads->links() }}
                </nav>
            @endif
        </section>

        <aside class="theatre-sidebar">
            <section class="theatre-panel" aria-labelledby="category-heading">
                <h2 id="category-heading" class="theatre-panel__title">Acts &amp; categories</h2>
                @forelse ($categories as $category)
                    <div class="theatre-category-row">
                        <div class="flex items-center justify-between gap-3">
                            <h3 class="theatre-category-row__name">{{ $category->name }}</h3>
                            <span class="theatre-category-row__count">{{ $category->threads_count }}</span>
                        </div>
                        @if ($category->description)
                            <p class="theatre-muted mt-1">{{ $category->description }}</p>
                        @endif
                    </div>
                @empty
                    <p class="theatre-muted mt-3">Categories will appear here.</p>
                @endforelse
            </section>

            <section class="theatre-panel" aria-labelledby="topics-heading">
                <h2 id="topics-heading" class="theatre-panel__title">Topics in the programme</h2>
                @if ($tags->isNotEmpty())
                    <ul class="theatre-topic-list">
                        @foreach ($tags as $tag)
                            <li class="theatre-chip">{{ $tag->name }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="theatre-muted mt-3">Topics will appear here.</p>
                @endif
            </section>

            <section class="theatre-panel theatre-note" aria-labelledby="audience-heading">
                <h2 id="audience-heading" class="theatre-panel__title">A note for the audience</h2>
                <p class="theatre-muted mt-3">Everyone can browse the theatre. Sign in to post, reply, and cast a vote.</p>
                @guest
                    <a href="{{ route('register') }}" class="mt-4 inline-flex text-sm font-semibold text-amber-100 underline underline-offset-4">Create an account</a>
                @endguest
            </section>
        </aside>
    </div>
</x-layout>
