<div class="tabbedwidget tab-primary">
    <ul>
        @foreach ($languages as $localeCode => $l)
        <li><a href="#tabs-upload-{{$localeCode}}">{{strtoupper($localeCode)}} <i class="fa fa-globe" aria-hidden="true"></i> <b>{{trans('lab.descriptions')}}</b></a></li>
        @endforeach

        <li><a href="#tabs-upload-settings"><i class="fa fa-wrench" aria-hidden="true"></i> {{trans('lab.settings')}}</a></li>
    </ul>

    @foreach ($languages as $localeCode => $l)
    <div id="tabs-upload-{{$localeCode}}">            
        @include('lab.upload.forms.create')
    </div>
    @endforeach

    <div id="tabs-upload-settings">
        @include('lab.upload.forms.settings')
    </div>
</div>