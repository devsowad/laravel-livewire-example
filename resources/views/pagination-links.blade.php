@if ($paginator->hasPages())
    <ul class="d-flex align-items-center">

        {{-- Previous --}}
        <button @if ($paginator->onFirstPage()) disabled @endif
            wire:click='previousPage' class="btn mr-2 btn-secondary">
            <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
        </button>
        {{-- Previous End --}}

        {{-- Links --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                ss
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <button @if ($page == $paginator->currentPage()) disabled @endif wire:click='gotoPage({{ $page }})'
                        class="btn btn-secondary mr-2">{{ $page }}</button>
                @endforeach
            @endif
        @endforeach
        {{-- Links End --}}

        {{-- Next --}}
        <button @if (!$paginator->hasMorePages()) disabled @endif
            wire:click='nextPage' class="btn btn-secondary">
            <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
        </button>
        {{-- Next End --}}
    </ul>
@endif
