@extends('web.index')

@section('content')

{{-- search products --}}
@include('web.ecommerce.category.search')

{{-- breadcrumb --}}
@include('web.ecommerce.category.breadcrumb')

<div class="row">
	<div class="col-md-4">

		{{-- contextual catalogue menu --}}
		@include('web.ecommerce.category.menu')

	</div>
	<div class="col-md-8">

		@if(isset($show_subcategory))
			{{-- subcategory item or something else --}}
			@include('web.ecommerce.subcategory.index')
		@endif

		@if(isset($show_search))
			{{-- subcategory item or something else --}}
			@include('web.ecommerce.search.index')
		@endif

		@if(isset($show_prod_detail))
			{{-- product detail --}}
			@include('web.ecommerce.product.show')		
		@endif

	</div>
</div>

@endsection