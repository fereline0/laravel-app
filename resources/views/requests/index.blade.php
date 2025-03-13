<x-dashboard-layout>
    <div class="space-y-4">
        <form method="GET" action="{{ route('dashboard.requests.index') }}">
            <x-bladewind::select name="sort" label="Сортировка" :data="$sortOptions" placeholder="Выберите сортировку"
                selected_value="{{ request('sort') }}" />
                
            <x-bladewind::button can_submit="true">Фильтровать</x-bladewind::button>
        </form>

        @foreach ($requests as $request)
            <x-bladewind::card>
              <div class="space-y-1">
                  <x-link href="{{ route('requests.show', $request->id) }}">
                    <h2 class="font-semibold text-xl leading-tight">{{ $request->title }}</h2>
                  </x-link>
                  <p>{{ Auth()->user()->id == $request->user->id ? 'Опубликовано вами' : $request->user->name }}
                  </p>
                  <p>{{ $request->is_closed ? 'Закрыто' : 'Открыто' }}</p>
                  <p class="text-gray-500">Было создано {{ $request->created_at->locale('ru')->diffForHumans() }}</p>
              </div>
            </x-bladewind::card>
        @endforeach

        {{ $requests->links() }}
    </div>
</x-dashboard-layout>