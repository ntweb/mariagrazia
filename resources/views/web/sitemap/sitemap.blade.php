{{$page->title}}
{!! $page->description !!}

<h3>{{trans('labels.office_info')}}</h3>
<ul>
	@foreach ($arrPages as $el)
	<li class="size09em">
		<a href="{{action('Web\PageController@show', array($el->murl, $el->id))}}">{{$el->title}}</a>
	</li>
	@endforeach
	<li class="size09em">
		<a href="{{action('Web\ContactController@index')}}">{{trans('labels.contatti')}}</a>
	</li>

</ul>