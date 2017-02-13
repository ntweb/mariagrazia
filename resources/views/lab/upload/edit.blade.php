<div class="tabbedwidget tab-primary">
    <ul>
        @foreach ($languages as $l)
        <li><a href="#tabs-upload-{{$l->id}}">{{strtoupper($l->lang)}} <i class="fa fa-globe" aria-hidden="true"></i> <b>{{trans('labels.descriptions')}}</b></a></li>
        @endforeach

        <li><a href="#tabs-upload-settings"><i class="fa fa-wrench" aria-hidden="true"></i> {{trans('labels.settings')}}</a></li>
    </ul>

    @foreach ($languages as $l)
    <div id="tabs-upload-{{$l->id}}">            
        @include('lab.upload.forms.create')
    </div>
    @endforeach

    <div id="tabs-upload-settings">
        @include('lab.upload.forms.settings')
    </div>
</div>