<x-admin-layout>
    <x-card class="space-y-4">
        <div>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Создать новую категорию') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Введите информацию о новой категории') }}
            </p>
        </div>

        <form method="post" action="{{ route('categories.store') }}" class="space-y-4">
            @csrf

            <div>
                <x-input-label for="name" :value="__('Название категории')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Создать') }}</x-primary-button>

                @if (session('status') === 'category-created')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400">{{ __('Категория создана') }}</p>
                @endif
            </div>
        </form>
    </x-card>
</x-admin-layout>