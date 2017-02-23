@if(isset($arrElements))
	@if (count($arrElements))


		{{-- important --}}
		<?php $cat = (session()->has('breadcrumb_cat')) ? session()->get('breadcrumb_cat') : null; ?>
		<?php $subcat = (session()->has('breadcrumb_subcat')) ? session()->get('breadcrumb_subcat') : null; ?>
		{{-- important --}}


        @foreach ($arrElements as $el)
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