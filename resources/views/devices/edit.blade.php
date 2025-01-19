<x-dashboard-layout>
    <x-bladewind::card>
        <header class="mb-10">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Редактировать устройство') }}
            </h2>
        </header>

        <form method="POST" action="{{ route('dashboard.devices.update', $device->id) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <x-bladewind::input class="rounded-md" label="Название устройства" name="name"
                    value="{{ old('name', $device->name) }}" required />
                <x-input-error :messages="$errors->get('name')" />
            </div>

            <div class="space-y-2">
                <x-bladewind::select name="category_id" label="Категория" :data="$categories"
                    selected_value="{{ old('category_id', $device->category_id) }}" required />
                <x-input-error :messages="$errors->get('category_id')" />
            </div>

            <div class="space-y-2">
                <x-bladewind::input class="rounded-md" label="Серийный номер" name="serial_number"
                    value="{{ old('serial_number', $device->serial_number) }}" required />
                <x-input-error :messages="$errors->get('serial_number')" />
            </div>

            <div class="space-y-2">
                <x-bladewind::input type="date" class="rounded-md" label="Дата покупки" name="purchase_date"
                    value="{{ old('purchase_date', $device->purchase_date->format('Y-m-d')) }}" required />
                <x-input-error :messages="$errors->get('purchase_date')" />
            </div>

            <div class="space-y-2">
                <x-bladewind::input type="number" class="rounded-md" label="Цена" name="price"
                    value="{{ old('price', $device->price) }}" required />
                <x-input-error :messages="$errors->get('price')" />
            </div>

            <x-bladewind::button can_submit="true">
                Обновить устройство
            </x-bladewind::button>
        </form>
    </x-bladewind::card>
</x-dashboard-layout>
