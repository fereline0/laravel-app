<x-guest-layout>
    <header class="mb-10">
        <h2 class="font-semibold text-center text-xl leading-tight">
            {{ __('Регистрация новой учетной записи') }}
        </h2>
    </header>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div class="space-y-2">
            <x-bladewind::input class="rounded-md" id="name" label="Имя" type="text" name="name"
                :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div class="space-y-2">
            <x-bladewind::input class="rounded-md" label="Электронная почта" id="email" type="email"
                name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="space-y-2">
            <x-bladewind::input class="rounded-md" label="Пароль" id="password" type="password" name="password"
                required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="space-y-2">
            <x-bladewind::input class="rounded-md" label="Подтверждение пароля" id="password_confirmation"
                type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="flex gap-4 items-center justify-end">
            <x-link href="{{ route('login') }}">
                {{ __('Есть аккаунт?') }}
            </x-link>

            <x-bladewind::button can_submit="true">
                {{ __('Зарегистрироваться') }}
            </x-bladewind::button>
        </div>
    </form>
</x-guest-layout>
