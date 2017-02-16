@extends('lab.product.default')

@section('content')

    <div class="widgetbox">
        <h4 class="widgettitle">{{trans('labels.edit')}}</h4>
        <div class="widgetcontent nopadding">

			@include('lab.product.forms.create')
			
        </div>
    </div>

@endsection