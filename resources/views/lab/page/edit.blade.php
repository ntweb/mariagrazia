@extends('lab.page.default')

@section('content')

    <div class="tabbedwidget tab-primary">
        <ul>
            <li><a href="#tabs-1">IT <i class="fa fa-globe" aria-hidden="true"></i> Descrizioni</a></li>
            <li><a href="#tabs-2">EN - Tab 2</a></li>
            <li><a href="#tabs-3"><i class="fa fa-wrench" aria-hidden="true"></i> Settaggi</a></li>
        </ul>
        <div id="tabs-1">
            
            @include('lab.page.forms.create')

        </div>
        <div id="tabs-2">
            Your content goes here for tab 2
        </div>
        <div id="tabs-3">
            Your content goes here for tab 3 
        </div>
    </div>

@endsection