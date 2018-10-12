@if ($paginator->lastPage() > 1)
  <ul class="pagination my-paginator-ul">
    <li class="waves-effect {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
    	@if($paginator->currentPage() == 1)
    		<i class="material-icons">chevron_left</i>
    	@else
    		<a href="{{ $paginator->url($paginator->currentPage()-1) }}"><i class="material-icons">chevron_left</i>
    		</a>
    	@endif
    </li>

    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
    	<li class="my-small-pagination waves-effect {{ ($paginator->currentPage() == $i) ? ' active' : '' }}"><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
	@endfor
	<li class="waves-effect {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
		@if($paginator->currentPage() == $paginator->lastPage())
			<i class="material-icons">chevron_right</i>
		@else
			<a href="{{ $paginator->url($paginator->currentPage()+1) }}"><i class="material-icons">chevron_right</i>
			</a>
		@endif
	</li>
  </ul>
@endif