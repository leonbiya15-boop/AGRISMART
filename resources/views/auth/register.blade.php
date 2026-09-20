<x-guest-layout>
    <div class="centre">
    <div class="auth-card">
        <h1 class="auth-title">Créer un compte</h1>

        <form method="POST" action="{{ route('register') }}" class="auth-form">
            @csrf

            <div class="form-group">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="form-input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="form-error" />
            </div>

            <div class="form-group">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="form-input" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="form-error" />
            </div>
          <div style="display: flex; gap: 8px;">
    <span style="
        display: flex;
        align-items: center;
        padding: 0 12px;
        background: #f1f5f2;
        border: 1px solid #dce7df;
        border-radius: 6px;
    ">
        +237
    </span>

    <x-text-input
        id="telephone"
        class="form-input"
        type="tel"
        name="telephone"
        :value="old('telephone')"
        required
        autocomplete="tel"
        placeholder="6XXXXXXXX"
        minlength="9"
        maxlength="9"
        pattern="6[0-9]{8}"
        inputmode="numeric"
        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
    />
</div>

<x-input-error :messages="$errors->get('telephone')" class="form-error" />

            <div class="form-group">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="form-input" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="form-error" />
            </div>

            <div class="form-group">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="form-error" />
            </div>

            <div class="form-actions">
                <a class="auth-link" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="auth-submit">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
     <style>
.centre {
    margin-top: 90px;
    display: grid;
    place-items: center;
}
        </style>
</x-guest-layout>