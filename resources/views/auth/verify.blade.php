@extends('web.index')

@section('content')

	@if($u)
		{{trans('labels.user_activated')}}. <a href="{{ url('/login') }}">{{trans('labels.login')}}</a>
	@else
		{{trans('labels.user_not_found')}}
	@endif

@endsection
