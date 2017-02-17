@extends('lab.coupon.default')

@section('content')

    <div class="tabbedwidget tab-primary">
        <ul>
            <li><a href="#tabs-it"><b>{{trans('labels.descriptions')}}</b></a></li>    
            <li><a href="#tabs-settings"><i class="fa fa-wrench" aria-hidden="true"></i> {{trans('labels.settings')}}</a></li>
        </ul>

        <div id="tabs-it">            
            @include('lab.coupon.forms.create')
        </div>

        <div id="tabs-settings">
            @include('lab.coupon.forms.settings')
        </div>
    </div>

@endsection