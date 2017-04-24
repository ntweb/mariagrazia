@extends('lab.staff.default')

@section('content')

    <div class="widgetbox">
        <h4 class="widgettitle">{{trans('lab.edit')}}</h4>
        <div class="widgetcontent nopadding">

			@include('lab.staff.forms.create')
			
        </div>
    </div>

@endsection