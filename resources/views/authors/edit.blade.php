<x-admin-layout>
    <x-card class="space-y-4">
        <div>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Редактировать автора') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Обновите информацию о авторе') }}
            </p>
        </div>

        <form method="post" action="{{ route('authors.update', $author->id) }}" class="space-y-4"
            enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div>
                <x-input-label for="name" :value="__('Имя автора')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $author->name)" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="description" :value="__('Описание автора')" />
                <x-textarea id="description" name="description"
                    class="mt-1 block w-full">{{ old('description', $author->description) }}</x-textarea>
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>

            <div>
                <x-input-label for="image" :value="__('Изображение автора')" />
                <x-image-uploader id="image" src="{{ $author->image ? Storage::url($author->image) : null }}"
                    alt="{{ $author->name }}" initials="{{ strtoupper(substr($author->name, 0, 1)) }}" />
                <x-input-error class="mt-2" :messages="$errors->get('image')" />
            </div>
            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Сохранить') }}</x-primary-button>

                @if (session('status') === 'author-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400">{{ __('Автор обновлен') }}</p>
                @endif
            </div>
        </form>
    </x-card>
</x-admin-layout>
