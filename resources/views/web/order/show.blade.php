@extends('web.index')

@section('content')

<?php 
	$u = $o->user;
	$b = $u->b;
?>

<div class="row">    
	<div class="col-md-6">

		<table class="table table-bordered table-invoice">
			<tr>
				<td >{{trans('labels.cart')}}</td>
				<td ><strong>{{$o->label}}</strong></td>
			</tr>
			<tr>
				<td>{{trans('labels.user')}}:</td>
				<td>
					{{$u->name}} {{$u->cognome}} <br>
					<i class="fa fa-envelope-o" aria-hidden="true"></i> <i>{{$u->email}}</i>
					 - 
					<i class="fa fa-telephone" aria-hidden="true"></i> <i>{{$b->telephone}}</i>
					<hr style="margin: 2px;">
					{{$b->businessname}} <br>
					{{trans('labels.vat')}} {{$b->vat}} / {{$b->cf}} <br>
					{{$b->address}}, {{$b->street_number}} <br>
					{{$b->postal_code}} - {{$b->city}} ({{$b->political_short_name}} {{$b->country_short_name}} )
				</td>
			</tr>
		</table>

		@if(!$o->paid && $o->payment->type == 'paypal')
		<br>
		<a href="{{action('Web\CartController@doPayment', array($o->id))}}">Paga ora</a>
		@endif

	</div>

	<div class="col-md-6">
		<table class="table table-bordered table-invoice">
			<tr>
				<td class="width30">{{trans('labels.shipping_data')}}:</td>
				<td class="width70">
					<strong>{{$o->shipment_name}}</strong> <br />
					{{$o->shipment_businessname}}, <br />
					{{$o->shipment_address}}, {{$o->shipment_street_number}} <br />
					{{$o->shipment_postal_code}} - {{$o->shipment_city}} ({{$o->shipment_political_short_name}} {{$o->shipment_country_short_name}} ) 
				</td>
			</tr>
			<tr>
				<td class="width30">{{trans('labels.note')}}:</td>
				<td class="width70">					
					<div style="font-size: 11px; line-height: 18px;">{{$o->shipment_note}}</div>
				</td>
			</tr>
		</table>

		<br />

		<table class="table table-bordered table-invoice">
			<tr>
				<td class="width30">{{trans('labels.shipment')}}</td>
				<td class="width70"><strong>{{$o->shipment->title}}</strong></td>
			</tr>
			<tr>
				<td>{{trans('labels.payment')}}</td>
				<td>
					<strong>{{$o->payment->title}}</strong>
					@if ($o->payment_token)
					<br>
					token: <i>{{$o->payment_token}}</i>
					@endif
				</td>
			</tr>
			@if ($o->id_coupon)
			<tr>
				<td>{{trans('labels.coupon')}}</td>
				<td><strong>{{$o->coupon->title}}</strong></td>
			</tr>
			@endif
		</table>
	</div>

</div><!--row-->
            
    <div class="clearfix"><br /></div>
    
    <table class="table table-bordered table-invoice-full">
        <colgroup>
            <col class="con0 width15" />
            <col class="con1 width45" />
            <col class="con0 width5" />
            <col class="con1 width15" />
            <col class="con0 width5" />
            <col class="con1 width15" />
            <col class="con0 width20" />
        </colgroup>
        <thead>
            <tr>
                <th class="head0">Product</th>
                <th class="head1">Description</th>
                <th class="head0 right">Quantity</th>
                <th class="head1 right">Unit Price</th>
                <th class="head1 right">Tax</th>
                <th class="head1 right">Taxable</th>
                <th class="head0 right">Amount</th>
            </tr>
        </thead>
        <tbody>
        	<?php
        		$_subtotal = 0;
        		$_tax = 0;
    		?>                	
        	@foreach ($o->rows()->get() as $r)
        	<?php
        		$_subtotal += $r->row_qty * $r->row_price;
        		$_tax += $r->row_taxable;                		
        	?>
            <tr>
                <td>{{$r->row_title}}</td>
                <td>{{$r->row_options}}</td>
                <td class="right">{{$r->row_qty}}</td>
                <td class="right">{{ euro($r->row_price) }}</td>
                <td class="right">{{$r->row_tax}} %</td>
                <td class="right">{{$r->row_taxable}}</td>
                <td class="right"><strong>{{ euro($r->row_qty * $r->row_price) }}</strong></td>
            </tr>
        	@endforeach
        </tbody>
    </table>
                        
    <table class="invoice-table">
        <tbody>
            <tr>
            	<td class="width65 msg-invoice">
						
                </td>
                <td class="width15 right numlist">
            	  	<strong>Subtotal</strong>
                    <strong>Tax</strong>                                
                </td>
                <td class="width20 right numlist">
                    <strong>{{ euro($_subtotal) }}</strong>
                    <strong>{{ euro($_tax) }}</strong>                                
                </td>
            </tr>
        </tbody>
		</table>
	
	<div class="amountdue">
		<h1><span>Total:</span> {{ euro($o->total) }}</h1> <br />            
	</div>



@endsection