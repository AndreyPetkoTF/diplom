@if ($paginator->lastPage() > 1)

	<div class="disc-paginator">
	@for ($i = 1; $i <= $paginator->lastPage(); $i++)
		<div class="disc-paginator-item {{ ($paginator->currentPage() == $i) ? ' disc-paginator-item-active' : '' }}"><a href="{{ $paginator->url($i) }}">{{$i}}</a></div>
	@endfor
	</div>

@endif