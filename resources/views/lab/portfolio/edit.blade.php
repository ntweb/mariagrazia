@extends('lab.portfolio.default')

@section('content')

    <div class="tabbedwidget tab-primary">
        <ul>
            <li><a href="#tabs-registy"><i class="fa fa-address-card-o" aria-hidden="true"></i> {{trans('labels.registy')}}</a></li>

            @foreach ($languages as $localeCode => $l)
            <li><a href="#tabs-{{$localeCode}}">{{strtoupper($localeCode)}} <i class="fa fa-globe" aria-hidden="true"></i> <b>{{trans('labels.descriptions')}}</b></a></li>
            @endforeach
    
            <li><a href="#tabs-images"><i class="fa fa-camera" aria-hidden="true"></i> {{trans('labels.images')}}</a></li>
            <li id="refresh-tabs-attachments" class="get-html" data-route="{{action('Lab\UploadController@index', array($el->id, $uploadfolder))}}" data-container="#tabs-attachments"><a href="#tabs-attachments"><i class="fa fa-paperclip" aria-hidden="true"></i> {{trans('labels.attachments')}}</a></li>
            <li><a href="#tabs-settings"><i class="fa fa-wrench" aria-hidden="true"></i> {{trans('labels.settings')}}</a></li>
        </ul>

        <div id="tabs-registy">
            @include('lab.portfolio.forms.registry')
        </div>

        @foreach ($languages as $localeCode => $l)
        <div id="tabs-{{$localeCode}}">            
            @include('lab.portfolio.forms.create')
        </div>
        @endforeach

        <div id="tabs-images">
            @include('lab.portfolio.forms.images')
        </div>
        <div id="tabs-attachments">
            {{-- loaded in RPC --}}
        </div>        
        <div id="tabs-settings">
            @include('lab.portfolio.forms.settings')
        </div>
    </div>

@endsection