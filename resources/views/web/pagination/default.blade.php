@if ($arrElements->lastPage() > 1)
<ul class="pagination pagination-sm">
	@for ($i = 1; $i <= $arrElements->lastPage(); $i++)
    <li class="@if($arrElements->currentPage() == $i) active @endif">
		<a href="{{$arrElements->url($i)}}" data-route="{{$arrElements->url($i)}}">{{$i}}</a>
    </li>
	@endfor
</ul>
@endif