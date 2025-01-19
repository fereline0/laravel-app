<x-dashboard-layout>
    <x-bladewind::card>
        <header class="mb-10">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Создать инвенторизацию') }}
            </h2>
        </header>

        <form method="POST" action="{{ route('dashboard.inventories.store') }}" class="space-y-4">
            @csrf

            <div class="space-y-2">
                <x-bladewind::select name="device_id" label="Устройство" :data="$devices"
                    placeholder="Выберите устройство" required />
                <x-input-error :messages="$errors->get('device_id')" />
            </div>

            <div class="space-y-2">
                <x-bladewind::input type="number" class="rounded-md" label="Количество" name="quantity" required />
                <x-input-error :messages="$errors->get('quantity')" />
            </div>

            <div class="space-y-2">
                <x-bladewind::select name="cabinet_id" label="Кабинет" :data="$cabinets" placeholder="Выберите кабинет"
                    required />
                <x-input-error :messages="$errors->get('cabinet_id')" />
            </div>

            <x-bladewind::button can_submit="true">
                Создать инвенторизацию
            </x-bladewind::button>
        </form>
    </x-bladewind::card>
</x-dashboard-layout>
