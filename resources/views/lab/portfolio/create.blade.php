@extends('lab.portfolio.default')

@section('content')

    <div class="widgetbox">
        <h4 class="widgettitle">{{trans('labels.edit')}}</h4>
        <div class="widgetcontent nopadding">

			@include('lab.portfolio.forms.create')
			
        </div>
    </div>

@endsection