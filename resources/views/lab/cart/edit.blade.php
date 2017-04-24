@extends('lab.news.default')

@section('content')

<?php 
	$u = $el->user;
	$b = $u->b;
?>

<div class="row">    
	<div class="col-md-6">

		<table class="table table-bordered table-invoice">
			<tr>
				<td class="width30">{{trans('lab.cart')}}</td>
				<td class="width70"><strong>{{$el->label}}</strong></td>
			</tr>
			<tr>
				<td>{{trans('lab.user')}}:</td>
				<td>
					{{$u->name}} {{$u->cognome}} <br>
					<i class="fa fa-envelope-o" aria-hidden="true"></i> <i>{{$u->email}}</i>
					 - 
					<i class="fa fa-telephone" aria-hidden="true"></i> <i>{{$b->telephone}}</i>
					<hr style="margin: 2px;">
					{{$b->businessname}} <br>
					{{trans('lab.vat')}} {{$b->vat}} / {{$b->cf}} <br>
					{{$b->address}}, {{$b->street_number}} <br>
					{{$b->postal_code}} - {{$b->city}} ({{$b->political_short_name}} {{$b->country_short_name}} )
				</td>
			</tr>
		</table>
		
		<br>

		<form class="ns" data-route="{{$route}}" data-method="PUT">
		{!! csrf_field() !!}
		<table class="table table-bordered table-invoice">
			<tr>
				<td class="width30">{{trans('lab.paid')}}:</td>
				<td class="width70">
					<select name="paid">
						<option value="0" @if(!$el->paid) selected="selected" @endif>{{trans('lab.no')}}</option>
						<option value="1" @if($el->paid) selected="selected" @endif>{{trans('lab.yes')}}</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>{{trans('lab.status')}}:</td>
				<td>
					<select name="type">
						@foreach ($arrType as $t)
						<option value="{{$t}}" @if($el->type == $t) selected="selected" @endif >{{$t}}</option>
						@endforeach
					</select>
				</td>
			</tr>
			<tr>
				<td></td>
				<td><button type="submit" class="btn btn-xs btn-primary">{{trans('lab.save')}}</button></td>
			</tr>
		</table>
		</form>

	</div>

	<div class="col-md-6">
		<table class="table table-bordered table-invoice">
			<tr>
				<td class="width30">{{trans('lab.shipping_data')}}:</td>
				<td class="width70">
					<strong>{{$el->shipment_name}}</strong> <br />
					{{$el->shipment_businessname}}, <br />
					{{$el->shipment_address}}, {{$el->shipment_street_number}} <br />
					{{$el->shipment_postal_code}} - {{$el->shipment_city}} ({{$el->shipment_political_short_name}} {{$el->shipment_country_short_name}} ) 
				</td>
			</tr>
			<tr>
				<td class="width30">{{trans('lab.note')}}:</td>
				<td class="width70">					
					<div style="font-size: 11px; line-height: 18px;">{{$el->shipment_note}}</div>
				</td>
			</tr>
		</table>

		<br />

		<table class="table table-bordered table-invoice">
			<tr>
				<td class="width30">{{trans('lab.shipment')}}</td>
				<td class="width70"><strong>{{$el->shipment->title}}</strong></td>
			</tr>
			<tr>
				<td>{{trans('lab.payment')}}</td>
				<td>
					<strong>{{$el->payment->title}}</strong>
					@if ($el->payment_token)
					<br>
					token: <i>{{$el->payment_token}}</i>
					@endif
				</td>
			</tr>
			@if ($el->payment_log)
			<tr>
				<td>{{trans('lab.payment_log')}}</td>
				<td>
					<textarea name="log" id="" rows="10" style="width: 100%;">
					{{$el->payment_log}}	
					</textarea>				
				</td>
			</tr>
			@endif
			@if ($el->id_coupon)
			<tr>
				<td>{{trans('lab.coupon')}}</td>
				<td><strong>{{$el->coupon->title}}</strong></td>
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
        	@foreach ($el->rows()->get() as $r)
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
		<h1><span>Total:</span> {{ euro($el->total) }}</h1> <br />            
	</div>

@endsection