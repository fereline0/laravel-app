<x-edit-layout :user="$user">
    <x-card class="space-y-4">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Детальная информация') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Обновите свою детальную информацию.') }}
            </p>
        </header>

        <form method="post" action="{{ route('users.userDetailInformation.update', $user->id) }}" class="mt-6 space-y-6"
            enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div>
                <x-image-uploader id="image"
                    src="{{ $user->detail_information->image ? Storage::url($user->detail_information->image) : null }}"
                    alt="{{ $user->name }}" initials="{{ strtoupper(substr($user->name, 0, 1)) }}" />
            </div>

            <div>
                <x-input-label for="about" :value="__('О себе')" />
                <x-text-input id="about" name="about" type="text" class="mt-1 block w-full"
                    :value="old('about', $user->detail_information->about)" />
                <x-input-error class="mt-2" :messages="$errors->get('about')" />
            </div>

            <div>
                <x-input-label for="gender" :value="__('Пол')" />
                <x-select id="gender" name="gender" class="mt-1 block w-full">
                    <option value="none"
                        {{ old('gender', $user->detail_information->gender) === 'none' ? 'selected' : '' }}>
                        {{ __('Выберите пол') }}</option>
                    <option value="male"
                        {{ old('gender', $user->detail_information->gender) === 'male' ? 'selected' : '' }}>
                        {{ __('Мужской') }}</option>
                    <option value="female"
                        {{ old('gender', $user->detail_information->gender) === 'female' ? 'selected' : '' }}>
                        {{ __('Женский') }}</option>
                </x-select>
                <x-input-error class="mt-2" :messages="$errors->get('gender')" />
            </div>

            <div>
                <x-input-label for="birthday" :value="__('Дата рождения')" />
                <x-text-input id="birthday" name="birthday" type="date" class="mt-1 block w-full"
                    :value="old('birthday', $user->detail_information->birthday)" />
                <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
            </div>

            <div>
                <x-input-label for="phone_number" :value="__('Номер телефона')" />
                <x-text-input id="phone_number" name="phone_number" type="text" class="mt-1 block w-full"
                    :value="old('phone_number', $user->detail_information->phone_number)" />
                <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Сохранить') }}</x-primary-button>

                @if (session('status') === 'detail-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400">{{ __('Сохранено') }}</p>
                @endif
            </div>
        </form>

        @if ($user->detail_information->image)
            <div class="mt-4">
                <x-danger-button x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-image-deletion-{{ $user->id }}')">
                    {{ __('Удалить изображение') }}
                </x-danger-button>
            </div>
        @endif
    </x-card>

    @if ($user->detail_information->image)
        <x-modal name="confirm-image-deletion-{{ $user->id }}" focusable>
            <form method="post" action="{{ route('users.userDetailInformation.image.delete', $user->id) }}"
                class="p-6">
                @csrf
                @method('DELETE')

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Вы уверены, что хотите удалить это изображение?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('После удаления изображение будет безвозвратно удалено.') }}
                </p>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Отменить') }}
                    </x-secondary-button>

                    <x-danger-button class="ms-3">
                        {{ __('Удалить изображение') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    @endif
</x-edit-layout>
