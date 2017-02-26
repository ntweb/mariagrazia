@extends('web.cart.index')

@section('content_cart')

	{{--  flash message --}}
	@if (session('cart_label') || session('message'))
	<p class="alert alert-success">
		{{ session('cart_label') }}
		<br>
		{{ session('message') }}
	</p>
	@endif

	{{-- return from paypal --}}
	@if(isset($order))
	<p class="alert alert-success center">
		{{trans('labels.transaction_complete')}} <br>
		{{$order->label}} 
	</p>
	@endif

@endsection