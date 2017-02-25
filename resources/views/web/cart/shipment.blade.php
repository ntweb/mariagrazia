@extends('web.cart.index')

@section('content_cart')

<table class="table"> 	
	<thead> 
		<tr> 
			<th>{{trans('labels.shipment')}}</th> {{-- product --}}
		 	<th>{{trans('labels.price')}}</th> {{-- prezzo --}}
		 	<th></th> {{-- select item --}}
		 </tr> 
 	</thead> 

 	<tbody> 

 		@foreach ($arrShipment as $el)
 		<tr> 
 			<td>
 				{{$el->title}}
 				@if($el->abstract)
 				<br><p style="font-size: 12px;">{{$el->abstract}}</p>
 				@endif
			</td> 
 			<td>{{ euro($el->price) }}</td> 
 			<td>
		        <a href="{{action('Web\CartController@shipment')}}?item={{$el->id}}">{{trans('labels.select')}}</a>
 			</td>
		</tr>
		@endforeach

	 </tbody> 	
</table>

@endsection