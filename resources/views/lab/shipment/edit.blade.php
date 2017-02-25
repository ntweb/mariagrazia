@extends('lab.shipment.default')

@section('content')

    <div class="tabbedwidget tab-primary">
        <ul>
            @foreach ($languages as $l)
            <li><a href="#tabs-{{$l->id}}">{{strtoupper($l->lang)}} <i class="fa fa-globe" aria-hidden="true"></i> <b>{{trans('labels.descriptions')}}</b></a></li>
            @endforeach
    
            <li><a href="#tabs-settings"><i class="fa fa-wrench" aria-hidden="true"></i> {{trans('labels.settings')}}</a></li>
        </ul>

        @foreach ($languages as $l)
        <div id="tabs-{{$l->id}}">            
            @include('lab.shipment.forms.create')
        </div>
        @endforeach

        <div id="tabs-settings">
            @include('lab.shipment.forms.settings')
        </div>
    </div>

@endsection