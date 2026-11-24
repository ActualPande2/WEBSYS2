<x-layout title="Log in">
    <section class="theatre-auth-card" aria-labelledby="login-heading">
        <div class="theatre-auth-intro">
            <div>
                <p class="theatre-kicker">The house lights are low</p>
                <h1 id="login-heading" class="theatre-auth-title">Welcome back.</h1>
                <p class="theatre-auth-description">Your seat is waiting. Sign in to return to the conversations, add a reply, or cast your vote.</p>
            </div>
            <div class="theatre-admit-ticket" aria-hidden="true">
                Admission
                <strong>Returning guest</strong>
            </div>
        </div>

        <div class="theatre-auth-form-panel">
            <p class="theatre-kicker">Member entrance</p>
            <form method="POST" action="{{ route('login.store') }}" class="theatre-form">
                @csrf

                <div class="theatre-form-field">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus class="theatre-input">
                    @error('email')
                        <p class="theatre-form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="theatre-form-field">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required class="theatre-input">
                </div>

                <button type="submit" class="theatre-action w-full">Sign in</button>
            </form>

            <p class="theatre-auth-switch">New to the theatre? <a href="{{ route('register') }}">Create an account</a></p>
        </div>
    </section>
</x-layout>
