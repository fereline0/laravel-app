<x-admin-layout>
    <x-card class="space-y-4">
        <div>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Создать нового автора') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Введите информацию о новом авторе') }}
            </p>
        </div>

        <form method="post" action="{{ route('authors.store') }}" class="space-y-4" enctype="multipart/form-data">
            @csrf

            <div>
                <x-input-label for="name" :value="__('Имя автора')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="description" :value="__('Описание автора')" />
                <x-textarea id="description" name="description"
                    class="mt-1 block w-full">{{ old('description') }}</x-textarea>
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>

            <div>
                <x-input-label for="image" :value="__('Изображение автора')" />
                <x-image-uploader id="image" src="{{ old('image') }}" alt="{{ old('name') }}"
                    initials="{{ strtoupper(substr(old('name', 'New author'), 0, 1)) }}" />
                <x-input-error class="mt-2" :messages="$errors->get('image')" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Создать') }}</x-primary-button>

                @if (session('status') === 'author-created')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400">{{ __('Автор создан') }}</p>
                @endif
            </div>
        </form>
    </x-card>
</x-admin-layout>
