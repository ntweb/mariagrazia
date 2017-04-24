@extends('lab.partner.default')

@section('content')

    <div class="widgetbox">
        <h4 class="widgettitle">{{trans('lab.edit')}}</h4>
        <div class="widgetcontent nopadding">

			@include('lab.partner.forms.create')
			
        </div>
    </div>

@endsection