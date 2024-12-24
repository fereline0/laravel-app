<x-admin-layout>
    <x-card class="space-y-4">
        <div>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Редактировать издательство') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Обновите информацию о издательстве') }}
            </p>
        </div>

        <form method="post" action="{{ route('publishers.update', $publisher->id) }}" class="space-y-4">
            @csrf
            @method('patch')

            <div>
                <x-input-label for="name" :value="__('Название издательства')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $publisher->name)" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Сохранить') }}</x-primary-button>

                @if (session('status') === 'publisher-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400">{{ __('Издательство обновлено') }}</p>
                @endif
            </div>
        </form>
    </x-card>
</x-admin-layout>
