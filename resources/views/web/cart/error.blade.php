@extends('web.index')

@section('content')

	<p class="alert alert-danger">
		@if (session('error'))
			{{ session('error') }}
		@else
			{{trans('labels.payment_generic_error')}}
		@endif
	</p>

@endsection