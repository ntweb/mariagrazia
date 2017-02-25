@extends('web.cart.index')

@section('content_cart')

	<p class="alert alert-success">
		{{ session('cart_label') }}
		<br>
		{{ session('message') }}
	</p>

@endsection