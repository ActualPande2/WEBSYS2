<x-layout title="Create an account">
    <section class="theatre-auth-card" aria-labelledby="register-heading">
        <div class="theatre-auth-intro">
            <div>
                <p class="theatre-kicker">A place in the audience</p>
                <h1 id="register-heading" class="theatre-auth-title">The next story needs you.</h1>
                <p class="theatre-auth-description">Join the Project Moon community to start discussions, follow the threads, and share your reading of the show.</p>
            </div>
            <div class="theatre-admit-ticket" aria-hidden="true">
                Admission
                <strong>New audience</strong>
            </div>
        </div>

        <div class="theatre-auth-form-panel">
            <p class="theatre-kicker">Create your pass</p>
            <form method="POST" action="{{ route('register.store') }}" class="theatre-form">
                @csrf

                <div class="theatre-form-field">
                    <label for="name">Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required autofocus class="theatre-input">
                    @error('name')
                        <p class="theatre-form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="theatre-form-field">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required class="theatre-input">
                    @error('email')
                        <p class="theatre-form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="theatre-form-field">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required class="theatre-input">
                    @error('password')
                        <p class="theatre-form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="theatre-form-field">
                    <label for="password_confirmation">Confirm password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required class="theatre-input">
                </div>

                <button type="submit" class="theatre-action w-full">Join the audience</button>
            </form>

            <p class="theatre-auth-switch">Already have a seat? <a href="{{ route('login') }}">Sign in</a></p>
        </div>
    </section>
</x-layout>
