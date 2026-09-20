<x-guest-layout>
    <div class="centre">
    <div class="auth-card">
        <h1 class="auth-title">Mot de passe oublié</h1>

        <div class="auth-status">
            {{ __('Mot de passe oublié ? Pas de problème. Indiquez-nous votre adresse email et nous vous enverrons un lien de réinitialisation.') }}
        </div>

        <x-auth-session-status class="auth-status" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="auth-form">
            @csrf

            <div class="form-group">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="form-input" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="form-error" />
            </div>

            <div class="form-actions">
                <x-primary-button class="auth-submit">
                    {{ __('Envoyer le lien de réinitialisation') }}
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