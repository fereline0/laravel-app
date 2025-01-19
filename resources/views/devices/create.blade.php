<x-dashboard-layout>
    <x-bladewind::card>
        <header class="mb-10">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Создать устройство') }}
            </h2>
        </header>

        <form method="POST" action="{{ route('dashboard.devices.store') }}" class="space-y-4">
            @csrf

            <div class="space-y-2">
                <x-bladewind::input class="rounded-md" label="Название устройства" name="name" required />
                <x-input-error :messages="$errors->get('name')" />
            </div>

            <div class="space-y-2">
                <x-bladewind::select name="category_id" label="Категория" :data="$categories" required />
                <x-input-error :messages="$errors->get('category_id')" />
            </div>

            <div class="space-y-2">
                <x-bladewind::input class="rounded-md" label="Серийный номер" name="serial_number" required />
                <x-input-error :messages="$errors->get('serial_number')" />
            </div>

            <div class="space-y-2">
                <x-bladewind::input type="date" class="rounded-md" label="Дата покупки" name="purchase_date"
                    required />
                <x-input-error :messages="$errors->get('purchase_date')" />
            </div>

            <div class="space-y-2">
                <x-bladewind::input type="number" class="rounded-md" label="Цена" name="price" required />
                <x-input-error :messages="$errors->get('price')" />
            </div>

            <x-bladewind::button can_submit="true">
                Создать устройство
            </x-bladewind::button>
        </form>
    </x-bladewind::card>
</x-dashboard-layout>
