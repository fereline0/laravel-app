<x-dashboard-layout>
    <x-bladewind::card>
        <header class="mb-10">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Редактировать кабинет') }}
            </h2>
        </header>

        <form method="POST" action="{{ route('dashboard.cabinets.update', $cabinet->id) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <x-bladewind::input class="rounded-md" label="Название кабинета" name="name"
                    value="{{ old('name', $cabinet->name) }}" required />
                <x-input-error :messages="$errors->get('name')" />
            </div>

            <x-bladewind::button can_submit="true">
                Обновить кабинет
            </x-bladewind::button>
        </form>
    </x-bladewind::card>
</x-dashboard-layout>
