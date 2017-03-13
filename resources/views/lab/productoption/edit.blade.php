<div class="tabbedwidget tab-primary">
    <ul>
        @foreach ($languages as $localeCode => $l)
        <li><a href="#tabs-{{$localeCode}}">{{strtoupper($localeCode)}} <i class="fa fa-globe" aria-hidden="true"></i></a></li>
        @endforeach

        <li><a href="#tabs-images"><i class="fa fa-camera" aria-hidden="true"></i> {{trans('labels.images')}}</a></li>
        <li><a href="#tabs-settings"><i class="fa fa-wrench" aria-hidden="true"></i> {{trans('labels.settings')}}</a></li>
    </ul>

    @foreach ($languages as $localeCode => $l)
    <div id="tabs-{{$localeCode}}">            
        @include('lab.productoption.forms.create')
    </div>
    @endforeach

    <div id="tabs-images">
        @include('lab.productoption.forms.images')
    </div>
    <div id="tabs-settings">
        @include('lab.productoption.forms.settings')
    </div>
</div>