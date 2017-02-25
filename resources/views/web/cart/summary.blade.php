@extends('web.cart.index')

@section('content_cart')

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

		@foreach (Cart::instance('shipment')->content() as $rowId => $row)
		<tr>
			<td></td>
			<td colspan="6" align="right">{{$row->name}}</td>
			<td>{{ euro( get_cart_total_ivato('shipment')) }}</td>
			<td></td>
		</tr>
		@endforeach

		@foreach (Cart::instance('payment')->content() as $rowId => $row)
		<tr>
			<td></td>
			<td colspan="6" align="right">{{$row->name}}</td>
			<td>{{ euro( get_cart_total_ivato('payment')) }}</td>
			<td></td>
		</tr>
		@endforeach

		<tr>
			<td colspan="7"></td>
			<td align="right">totale: {{ euro( get_cart_total_ivato('main') + Cart::instance('coupon')->subtotal + get_cart_total_ivato('shipment') + get_cart_total_ivato('payment') )}}</td>
			<td></td>
		</tr>

	 </tbody> 	

</table>

<hr>

<h2>Dati di spedizione</h2>
<form action="{{action('Web\CartController@store')}}" method="POST">
{!! csrf_field() !!}    {{-- token --}}

	<?php 
		$u = Auth::user();
		$b = $u->b; 
	?>

	<div class="row">

	    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	        <label for="name" class="col-md-4 control-label">{{trans('labels.name')}}</label>

	        <div class="col-md-6">
	            <input type="text" class="form-control" name="name" value="{{ old('name', $u->name) }}">

	            @if ($errors->has('name'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('name') }}</strong>
	                </span>
	            @endif
	        </div>
	    </div>

	    <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
	        <label for="name" class="col-md-4 control-label">{{trans('labels.lastname')}}</label>

	        <div class="col-md-6">
	            <input type="text" class="form-control" name="lastname" value="{{ old('lastname', $u->lastname) }}">

	            @if ($errors->has('lastname'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('lastname') }}</strong>
	                </span>
	            @endif
	        </div>
	    </div>

	    <div class="form-group{{ $errors->has('businessname') ? ' has-error' : '' }}">
	        <label for="name" class="col-md-4 control-label">{{trans('labels.businessname')}}</label>

	        <div class="col-md-6">
	            <input type="text" class="form-control" name="businessname" value="{{ old('businessname', $b->businessname) }}">

	            @if ($errors->has('businessname'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('businessname') }}</strong>
	                </span>
	            @endif
	        </div>
	    </div>

	    <div class="form-group{{ $errors->has('cf') ? ' has-error' : '' }}">
	        <label for="name" class="col-md-4 control-label">{{trans('labels.cf')}}</label>

	        <div class="col-md-6">
	            <input type="text" class="form-control" name="cf" value="{{ old('cf', $b->cf) }}">

	            @if ($errors->has('cf'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('cf') }}</strong>
	                </span>
	            @endif
	        </div>
	    </div>

	    <div class="form-group{{ $errors->has('vat') ? ' has-error' : '' }}">
	        <label for="name" class="col-md-4 control-label">{{trans('labels.vat')}}</label>

	        <div class="col-md-6">
	            <input type="text" class="form-control" name="vat" value="{{ old('vat', $b->vat) }}">

	            @if ($errors->has('vat'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('vat') }}</strong>
	                </span>
	            @endif
	        </div>
	    </div>

	    <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
	        <label for="name" class="col-md-4 control-label">{{trans('labels.telephone')}}</label>

	        <div class="col-md-6">
	            <input type="text" class="form-control" name="telephone" value="{{ old('telephone', $b->telephone) }}">

	            @if ($errors->has('telephone'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('telephone') }}</strong>
	                </span>
	            @endif
	        </div>
	    </div>

	    <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
	        <label for="name" class="col-md-4 control-label">{{trans('labels.city')}}</label>

	        <div class="col-md-6">
	            <input type="hidden" name="political_short_name" value="{{ old('city', $b->political_short_name) }}">
	            <input type="hidden" name="country_short_name" value="{{ old('city', $b->country_short_name) }}">
	            <input type="hidden" name="place_id" value="{{ old('city', $b->place_id) }}">

	            <input type="text" class="form-control" name="city" value="{{ old('city', $b->city) }}">

	            @if ($errors->has('city'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('city') }}</strong>
	                </span>
	            @endif
	        </div>
	    </div>

	    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
	        <label for="name" class="col-md-4 control-label">{{trans('labels.address')}}</label>

	        <div class="col-md-6">
	            <input type="text" class="form-control" name="address" value="{{ old('address', $b->address) }}">

	            @if ($errors->has('address'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('address') }}</strong>
	                </span>
	            @endif
	        </div>
	    </div>

	    <div class="form-group{{ $errors->has('street_number') ? ' has-error' : '' }}">
	        <label for="name" class="col-md-4 control-label">{{trans('labels.street_number')}}</label>

	        <div class="col-md-6">
	            <input type="text" class="form-control" name="street_number" value="{{ old('street_number', $b->street_number) }}">

	            @if ($errors->has('street_number'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('street_number') }}</strong>
	                </span>
	            @endif
	        </div>
	    </div>

	    <div class="form-group{{ $errors->has('postal_code') ? ' has-error' : '' }}">
	        <label for="name" class="col-md-4 control-label">{{trans('labels.postal_code')}}</label>

	        <div class="col-md-6">
	            <input type="text" class="form-control" name="postal_code" value="{{ old('postal_code', $b->postal_code) }}">

	            @if ($errors->has('postal_code'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('postal_code') }}</strong>
	                </span>
	            @endif
	        </div>
	    </div>

	    <div class="form-group">
	        <label for="name" class="col-md-4 control-label">{{trans('labels.note')}}</label>

	        <div class="col-md-6">
	        	<textarea name="note" id="" cols="30" rows="10" class="form-control">{{ old('note') }}</textarea>	            
	        </div>
	    </div>

	</div>

	<button type="submit">{{trans('labels.store_cart')}}</button>

</form>	

@endsection