@extends('web.cart.index')

@section('content_cart')

<table class="table"> 	
	<thead> 
		<tr> 
			<th>{{trans('labels.payment')}}</th> {{-- product --}}
		 	<th>{{trans('labels.price')}}</th> {{-- prezzo --}}
		 	<th></th> {{-- select item --}}
		 </tr> 
 	</thead> 

 	<tbody> 

 		@foreach ($arrPayment as $el)
 		<tr> 
 			<td>
 				{{$el->title}}
 				@if($el->abstract)
 				<br><p style="font-size: 12px;">{{$el->abstract}}</p>
 				@endif
			</td> 
 			<td>
 				@if ($el->amount_type == 'value')
 					+ {{ euro($el->amount) }}
				@else
					+ {{ percent($el->amount) }} %
				@endif
			</td> 
 			<td>
		        <a href="{{action('Web\CartController@payment')}}?item={{$el->id}}">{{trans('labels.select')}}</a>
 			</td>
		</tr>
		@endforeach

	 </tbody> 	
</table>

@endsection