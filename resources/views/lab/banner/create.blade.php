@extends('lab.banner.default')

@section('content')

    <div class="widgetbox">
        <h4 class="widgettitle">{{trans('lab.edit')}}</h4>
        <div class="widgetcontent nopadding">

			@include('lab.banner.forms.create')
			
        </div>
    </div>

@endsection