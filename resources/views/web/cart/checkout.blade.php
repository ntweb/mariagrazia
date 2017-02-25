@extends('web.cart.index')

@section('content_cart')

@if (Cart::instance('main')->count() <= 0)
	<p class="alert alert-info center">
		{{trans('labels.cart_empty')}}
	</p>
@else

<table class="table"> 	
	<thead> 
		<tr> 
			<th></th> {{-- immagine --}}
			<th>{{trans('labels.product')}}</th> {{-- product --}}
		 	<th>{{trans('labels.price')}}</th> {{-- prezzo --}}
		 	<th>{{trans('labels.qty')}}</th> {{-- qty--}}
		 	<th>{{trans('labels.subtotal')}}</th> {{-- subt. price tax (prezzo con iva) --}}
		 	<th>{{trans('labels.tax')}}</th> {{-- tax (iva %) --}}
		 	<th>{{trans('labels.taxable')}}</th> {{-- tax price (iva val.) --}}		 	
		 	<th>{{trans('labels.total')}}</th> {{-- tax price (iva val.) --}}		 	
		 	<th></th> {{-- delete item --}}
		 </tr> 
 	</thead> 

 	<tbody> 

 		@foreach (Cart::instance('main')->content() as $rowId => $row)
 		<tr class="row-{{$rowId}}"> 
 			<td> {{-- images --}}
				@if (isset($row->options->product['thumb']))
				<img src="{{$row->options->product['thumb']}}" alt="">
				@endif
 			</td>
 			<td>{{$row->name}}</td> 
 			<td>{{ euro($row->options->product['price']) }}</td> 
 			<td>{{$row->qty}}</td> 
 			<td>{{ euro($row->subtotal) }}</td> 
 			<td>{{$row->options->product['tax']}} %</td> 
 			<td>{{ euro(iva($row->options->product['price']*$row->qty, $row->options->product['tax'])) }}</td> 
 			<td>{{ euro(ivato($row->options->product['price']*$row->qty, $row->options->product['tax'])) }}</td> 
 			<td>
		        <a href="javascript:void(0);" data-cart-widget="delete" data-v=".row-{{$rowId}}" data-route="{{action('Web\CartController@delete', array($rowId))}}?force_page_refresh=true">x</a>
 			</td>
		</tr>
		@endforeach

		@foreach (Cart::instance('coupon')->content() as $rowId => $row)
		<tr>
			<td></td>
			<td colspan="6" align="right">{{$row->name}}</td>
			<td>{{ euro($row->subtotal) }}</td>
			<td></td>
		</tr>
		@endforeach

		<tr>
			<td colspan="7"></td>
			<td align="right">totale: {{ euro( get_cart_total_ivato('main') + Cart::instance('coupon')->subtotal )}}</td>
			<td></td>
		</tr>

	 </tbody> 	

</table>

{{-- coupon --}}
@if (Cart::instance('coupon')->count() <= 0)
	@if (session()->has('coupon_error'))
		<p class="alert alert-danger">{{session()->get('coupon_error')}}</p>
	@endif

	<form action="{{action('Web\CartController@coupon')}}" method="GET"> 
		{{trans('labels.insert_coupon:text')}}
		<input type="text" name="coupon" value="" placeholder="{{trans('labels.insert_coupon')}}">
		<button type="submit">{{trans('labels.insert')}}</button>
	</form>
@endif

<a href="{{action('Web\CartController@shipment')}}">{{trans('labels.continue')}}</a>

@endif

@endsection