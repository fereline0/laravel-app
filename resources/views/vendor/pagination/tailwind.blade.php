@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex flex-wrap gap-2">
        @foreach ($elements as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <x-bladewind::button disabled="true">
                            {{ $page }}
                        </x-bladewind::button>
                    @else
                        <x-bladewind::button tag="a" href="{{ $url }}">
                            {{ $page }}
                        </x-bladewind::button>
                    @endif
                @endforeach
            @endif
        @endforeach
    </nav>
@endif
