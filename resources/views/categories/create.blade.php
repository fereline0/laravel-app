<x-dashboard-layout>
    <x-bladewind::card>
        <header class="mb-10">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Создать категорию') }}
            </h2>
        </header>

        <form method="POST" action="{{ route('dashboard.categories.store') }}" class="space-y-4">
            @csrf

            <div class="space-y-2">
                <x-bladewind::input class="rounded-md" label="Название категории" name="name" required />
                <x-input-error :messages="$errors->get('name')" />
            </div>

            <x-bladewind::button can_submit="true">
                Создать категорию
            </x-bladewind::button>
        </form>
    </x-bladewind::card>
</x-dashboard-layout>
