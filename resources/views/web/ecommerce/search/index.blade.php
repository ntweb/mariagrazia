@if(isset($arrElements))
	@if (count($arrElements))

        @foreach ($arrElements as $el)

		{{-- important --}}
		<?php $subcat = $el->subcategory ?>
		<?php $cat = $subcat->category; ?>
		{{-- important --}}

        <div class="col-md-3">                
            {{$el->title}} <br>
            {{$el->code}} <br>
            
            @if ($el->img)
            <img src="{{img($el,'img','Nx300')}}" class="img-responsive" alt="">
            @endif

            <br><br>
            <a href="{{action('Web\ProductController@show', array($cat->murl, $subcat->murl, $el->murl, $el->id))}}">Leggi</a>

        </div>
        @endforeach	

	    <!-- pagination -->
	    @include('web.pagination.default')            

	@else

		<p class="alert alert-warning">{{trans('labels.no_element_to_show')}}</p>

	@endif
@endif