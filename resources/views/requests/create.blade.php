<x-app-layout>
  <x-bladewind::card>
      <header class="mb-10">
          <h2 class="font-semibold text-xl leading-tight">
              {{ __('Создать обращение') }}
          </h2>
      </header>

      <form method="POST" action="{{ route('requests.store') }}" class="space-y-4">
          @csrf

          <div class="space-y-2">
              <x-bladewind::input class="rounded-md" label="Заголовок обращения" name="title" required />
              <x-input-error :messages="$errors->get('title')" />
          </div>

          <div class="space-y-2">
              <x-bladewind::textarea class="rounded-md" label="Содержимое обращения" name="value" required />
              <x-input-error :messages="$errors->get('value')" />
          </div>

          <x-bladewind::button can_submit="true">
              Создать обращение
          </x-bladewind::button>
      </form>
  </x-bladewind::card>
</x-app-layout>