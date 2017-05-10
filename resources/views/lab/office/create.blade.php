@extends('lab.office.default')

@section('content')

    <div class="widgetbox">
        <h4 class="widgettitle">{{trans('lab.edit')}}</h4>
        <div class="widgetcontent nopadding">

			@include('lab.office.forms.create')
			
        </div>
    </div>

@endsection