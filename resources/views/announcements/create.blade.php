<x-dashboard-layout>
    <x-bladewind::card>
        <header class="mb-10">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Создать объявление') }}
            </h2>
        </header>

        <form method="POST" action="{{ route('dashboard.announcements.store') }}" class="space-y-4">
            @csrf

            <div class="space-y-2">
                <x-bladewind::input class="rounded-md" label="Заголовок" name="title" required />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div class="space-y-2">
                <x-bladewind::textarea label="Содержимое" name="value" required />
                <x-input-error :messages="$errors->get('value')" class="mt-2" />
            </div>

            <x-bladewind::button can_submit="true">
                Создать объявление
            </x-bladewind::button>
        </form>
    </x-bladewind::card>
</x-dashboard-layout>
