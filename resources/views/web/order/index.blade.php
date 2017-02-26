@extends('web.index')

@section('content')

    {{$page->title}}
    <br>
    {{$page->description}}


	<table>
		<thead>
			<td>Label</td>
			<td>Amount</td>
			<td>Date</td>
			<td>Status</td>
			<td>Payment</td>
		</thead>

		<tbody>
		@foreach ($arrElements as $el)
			<tr>
				<td><a href="{{action('Web\OrderController@show', array($el->id))}}">{{$el->label}}</a></td>
				<td>{{ euro($el->total) }}</td>
				<td>{{ fdate($el->created_at) }}</td>
				<td>{{$el->status}}</td>
				<td>
					@if(!$el->paid)
						not paid
					@else
						paid
					@endif
				</td>
			</tr>			
    	@endforeach
		</tbody>
	</table>



@endsection