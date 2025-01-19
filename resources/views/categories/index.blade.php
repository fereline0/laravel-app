<x-dashboard-layout>
    <div class="space-y-4">
        <form method="GET" action="{{ route('dashboard.categories.index') }}">
            <x-bladewind::input type="text" name="search" label="Поисковый запрос" value="{{ request('search') }}"
                class="rounded-md" />
            <x-bladewind::select name="sort" :data="$sortOptions" placeholder="Сортировка"
                selected_value="{{ request('sort') }}" />
            <x-bladewind::button can_submit="true">Поиск</x-bladewind::button>
        </form>

        @can('create category')
            <div class="flex justify-end">
                <x-bladewind::button tag="a" href="{{ route('dashboard.categories.create') }}">Создать
                    категорию</x-bladewind::button>
            </div>
        @endcan

        @foreach ($categories as $category)
            <x-bladewind::card>
                <div class="flex justify-between gap-4">
                    <div class="space-y-1">
                        <h2 class="font-semibold text-xl leading-tight">{{ $category->name }}</h2>
                        <p>Было создано {{ $category->created_at->locale('ru')->diffForHumans() }}</p>
                    </div>
                    @canany(['edit category', 'delete category'])
                        <x-bladewind::dropmenu>
                            @can('edit category')
                                <a href="{{ route('dashboard.categories.edit', $category->id) }}">
                                    <x-bladewind::dropmenu-item>Изменить</x-bladewind::dropmenu-item>
                                </a>
                            @endcan
                            @can('delete category')
                                <x-bladewind::dropmenu-item
                                    onclick="showModal('delete-{{ $category->id }}')">Удалить</x-bladewind::dropmenu-item>
                            @endcan
                        </x-bladewind::dropmenu>
                    @endcanany
                </div>
            </x-bladewind::card>

            @can('delete category')
                <x-bladewind::modal type="error" title="Вы уверены, что хотите удалить данную категорию?"
                    name="delete-{{ $category->id }}" show_action_buttons="false">
                    Данное действие необратимо, восстановить категорию после удаления будет невозможно.
                    <form class="flex justify-end" method="POST"
                        action="{{ route('dashboard.categories.destroy', $category->id) }}">
                        @csrf
                        @method('DELETE')

                        <x-bladewind::button can_submit="true" color="red">Удалить</x-bladewind::button>
                    </form>
                </x-bladewind::modal>
            @endcan
        @endforeach

        {{ $categories->links() }}
    </div>
</x-dashboard-layout>
