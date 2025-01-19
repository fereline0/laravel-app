<x-dashboard-layout>
    <x-bladewind::card>
        <header class="mb-10">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Редактировать категорию') }}
            </h2>
        </header>

        <form method="POST" action="{{ route('dashboard.categories.update', $category->id) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <x-bladewind::input class="rounded-md" label="Название категории" name="name"
                    value="{{ old('name', $category->name) }}" required />
                <x-input-error :messages="$errors->get('name')" />
            </div>

            <x-bladewind::button can_submit="true">
                Обновить категорию
            </x-bladewind::button>
        </form>
    </x-bladewind::card>
</x-dashboard-layout>
