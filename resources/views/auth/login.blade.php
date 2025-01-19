<x-guest-layout>
    <header class="mb-10">
        <h2 class="font-semibold text-center text-xl leading-tight">
            {{ __('Вход в учетную запись') }}
        </h2>
    </header>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div class="space-y-2">
            <x-bladewind::input class="rounded-md" label="Электронная почта" id="email" type="email" name="email"
                :value="old('email')" required autofocus autocomplete="username" />

            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="space-y-2">
            <x-bladewind::input class="rounded-md" label="Пароль" id="password" type="password" name="password"
                required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div>
            <x-bladewind::checkbox label="Запомнить меня" id="remember_me" name="remember" />
        </div>

        <div class="flex gap-4 items-center justify-end">
            <x-link href="{{ route('register') }}">
                {{ __('Нет аккаунта?') }}
            </x-link>

            <x-bladewind::button can_submit="true">Войти</x-bladewind::button>
        </div>
    </form>
</x-guest-layout>
