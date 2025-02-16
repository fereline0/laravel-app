<x-dashboard-layout>
    <x-bladewind::card>
        <header class="mb-10">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Редактировать инвенторизацию') }}
            </h2>
        </header>

        <form method="POST" action="{{ route('dashboard.inventories.update', $inventory->id) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <x-bladewind::select name="device_id" label="Устройство" :data="$devices"
                    placeholder="Выберите устройство" selected_value="{{ old('device_id', $inventory->device_id) }}"
                    required />
                <x-input-error :messages="$errors->get('device_id')" />
            </div>

            <div class="space-y-2">
                <x-bladewind::input type="number" class="rounded-md" label="Количество" name="quantity"
                    value="{{ old('quantity', $inventory->quantity) }}" required />
                <x-input-error :messages="$errors->get('quantity')" />
            </div>

            <div class="space-y-2">
                <x-bladewind::select name="cabinet_id" label="Кабинет" :data="$cabinets" placeholder="Выберите кабинет"
                    selected_value="{{ old('cabinet_id', $inventory->cabinet_id) }}" required />
                <x-input-error :messages="$errors->get('cabinet_id')" />
            </div>

            <x-bladewind::button can_submit="true">
                Обновить инвенторизацию
            </x-bladewind::button>
        </form>
    </x-bladewind::card>
</x-dashboard-layout>
