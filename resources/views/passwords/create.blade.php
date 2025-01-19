<x-dashboard-layout>
    <x-bladewind::card>
        <header class="mb-10">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Создать пароль') }}
            </h2>
        </header>

        <form method="POST" action="{{ route('dashboard.passwords.store') }}" class="space-y-4">
            @csrf

            <div class="space-y-2">
                <x-bladewind::input class="rounded-md" label="Источник" name="source" required />
                <x-input-error :messages="$errors->get('source')" />
            </div>

            <div class="space-y-2">
                <x-bladewind::input type="password" class="rounded-md" label="Пароль" name="value" required />
                <x-input-error :messages="$errors->get('value')" />
            </div>

            <div class="space-y-2">
                <x-checkbox id="privacy" name="privacy" label="Приватный" :checked="old('privacy')" />
                <x-input-error :messages="$errors->get('privacy')" />
            </div>

            <x-bladewind::button can_submit="true">
                Создать пароль
            </x-bladewind::button>
        </form>
    </x-bladewind::card>
</x-dashboard-layout>
