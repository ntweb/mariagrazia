@extends('lab.product.default')

@section('content')

    <div class="tabbedwidget tab-primary">
        <ul>
            @foreach ($languages as $l)
            <li><a href="#tabs-{{$l->id}}">{{strtoupper($l->lang)}} <i class="fa fa-globe" aria-hidden="true"></i> <b>{{trans('labels.descriptions')}}</b></a></li>
            @endforeach
    
            <li><a href="#tabs-images"><i class="fa fa-camera" aria-hidden="true"></i> {{trans('labels.images')}}</a></li>

            <li id="refresh-tabs-attachments" class="get-html" data-route="{{action('Lab\UploadController@index', array($el->id, $uploadfolder))}}" data-container="#tabs-attachments"><a href="#tabs-attachments"><i class="fa fa-paperclip" aria-hidden="true"></i> {{trans('labels.attachments')}}</a></li>

            <li id="refresh-tabs-productoptions" class="get-html" data-route="{{action('Lab\ProductoptionController@index')}}?id_product={{$el->id}}" data-container="#tabs-productoptions"><a href="#tabs-productoptions"><i class="fa fa-check-square-o" aria-hidden="true"></i> {{trans('labels.options')}}</a></li>

            <li><a href="#tabs-settings"><i class="fa fa-wrench" aria-hidden="true"></i> {{trans('labels.settings')}}</a></li>
        </ul>

        @foreach ($languages as $l)
        <div id="tabs-{{$l->id}}">            
            @include('lab.product.forms.create')
        </div>
        @endforeach

        <div id="tabs-images">
            @include('lab.product.forms.images')
        </div>
        <div id="tabs-attachments">
            {{-- loaded in RPC --}}
        </div>        
        <div id="tabs-productoptions">
            {{-- loaded in RPC --}}
        </div>        
        <div id="tabs-settings">
            @include('lab.product.forms.settings')
        </div>
    </div>

@endsection