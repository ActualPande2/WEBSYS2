<header class="theatre-header">
    <div class="theatre-header__inner">
        <a href="{{ route('home') }}" class="theatre-brand" aria-label="Project Moon Board home">
            <span class="theatre-brand__seal" aria-hidden="true">PM</span>
            <span>
                <span class="theatre-brand__title">Project Moon Board</span>
                <span class="theatre-brand__subtitle">The discussion theatre</span>
            </span>
        </a>

        <nav class="theatre-navigation" aria-label="Main navigation">
            <a href="{{ route('threads.index') }}" @class([
                'theatre-nav-link is-active' => request()->routeIs('threads.*'),
                'theatre-nav-link' => ! request()->routeIs('threads.*'),
            ])>
                Discussions
            </a>
            <a href="{{ route('categories.index') }}" @class([
                'theatre-nav-link is-active' => request()->routeIs('categories.*'),
                'theatre-nav-link' => ! request()->routeIs('categories.*'),
            ])>
                Categories
            </a>
            <a href="{{ route('tags.index') }}" @class([
                'theatre-nav-link is-active' => request()->routeIs('tags.*'),
                'theatre-nav-link' => ! request()->routeIs('tags.*'),
            ])>
                Tags
            </a>

            @auth
                <a href="{{ route('threads.create') }}" class="theatre-action">
                    New thread
                </a>
                <span class="theatre-user">{{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="theatre-logout-form">
                    @csrf
                    <button type="submit" class="theatre-button-link">
                        Log out
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="theatre-nav-link">Log in</a>
                <a href="{{ route('register') }}" class="theatre-action theatre-action--ghost">
                    Register
                </a>
            @endauth
        </nav>
    </div>
</header>
