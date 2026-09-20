<x-guest-layout>
    <div class="centre">
    <div class="auth-card">
        <h1 class="auth-title">Connexion</h1>

        <x-auth-session-status class="auth-status" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf
            <div class="form-group">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="form-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="form-error" />
            </div>

            <div class="form-group">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="form-error" />
            </div>

                 <div class="form-remember">
                <label for="remember_me" class="remember-label">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span>{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="form-actions">
                @if (Route::has('password.request'))
                    <a class="auth-link" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

               <x-primary-button class="auth-submit">
    {{ __('Log in') }}
</x-primary-button>
            </div>
        </form>
    </div>
    </div>
           <style>
.centre {
    margin-top: 90px;
    display: grid;
    place-items: center;
}
        </style>
</x-guest-layout>  