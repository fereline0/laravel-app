<x-dashboard-layout>
    <x-bladewind::card>
        <header class="mb-10">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Редактировать пароль') }}
            </h2>
        </header>

        <form method="POST" action="{{ route('dashboard.passwords.update', $password->id) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <x-bladewind::input class="rounded-md" label="Источник" name="source"
                    value="{{ old('source', $password->source) }}" required />
                <x-input-error :messages="$errors->get('source')" />
            </div>

            <div class="space-y-2">
                <x-bladewind::input type="password" class="rounded-md" label="Пароль" name="value" required />
                <x-input-error :messages="$errors->get('value')" />
            </div>

            <div class="space-y-2">
                <x-checkbox id="privacy" name="privacy" label="Приватный" :checked="old('privacy', $password->privacy)" />
                <x-input-error :messages="$errors->get('privacy')" />
            </div>

            <x-bladewind::button can_submit="true">
                Обновить пароль
            </x-bladewind::button>
        </form>
    </x-bladewind::card>
</x-dashboard-layout>
