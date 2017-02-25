@extends('web.index')

@section('content')

	<p class="alert alert-danger">
		{{ session('error') }}
	</p>

@endsection