@extends('web.index')

@section('content')

	{{-- breadcrumb --}}
	@include('web.cart.breadcrumb')

	{{-- what we see during cart steps --}}
	@yield('content_cart')

@endsection