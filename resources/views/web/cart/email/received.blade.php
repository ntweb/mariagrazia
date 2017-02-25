@component('mail::message')

Gentile utente,<br>
qui di seguito trova il riepilogo del suo ordine.
<br>
<br>
Ordine: {{$order->label}}

@component('mail::table')

| Prod       		| Des			   	   | Qty         	 | Price 				|
| :------------- 	| :----------------	   | -----------:	 | ----------------:	|
@foreach ($order->rows()->get() as $r)
| {{$r->row_title}} | {{$r->row_options}}  | {{$r->row_qty}} | {{$r->row_subtotal}} |
@endforeach
| 			 		|	 				   | Totale 	 	 | {{euro($order->total)}}	|

@endcomponent

@if($order->payment->consumer_message)
@component('mail::panel')
Modalutà di pagamento: {{$order->payment->title}} <br>
{{$order->payment->consumer_message}}
@endcomponent
@endif

@endcomponent
