@if ($paginator->hasPages())
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
			<li class="page-item"><a class="page-link" href="#"><i class="fa fa-arrow-left"></i></a></li>
        @else
			<li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-arrow-left"></i></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span></span></li>
			    <li class="page-item"><a class="{{ $url }}" href="#">{{ $element }}</a></li>

            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
					<li class="page-item active"><a class="page-link" href="#">{{ $page }}</a></li>
                    @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
			<li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}"><i class="fa fa-arrow-right"></i></a></li>
        @else
			<li class="page-item"><a class="page-link" href="#"><i class="fa fa-arrow-right"></i></a></li>
        @endif
@endif