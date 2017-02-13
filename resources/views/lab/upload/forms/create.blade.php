<form class="stdform stdform2 ns" data-route="{{$route}}" data-method='PUT'>
{!! csrf_field() !!}    {{-- token --}}
@if (isset($l))         {{-- locale --}}
<input type="hidden" name="lang" value="{{$l->lang}}">
@endif

    {{-- editing --}}
    <p>
        <label>{{trans('labels.mtitle')}}</label>
        <span class="field">
            <input type="text" name="mtitle" class="form-control" value="{{@$el->translate($l->lang)->mtitle}}" />
        </span>
    </p>

    <p>
        <label>{{trans('labels.mdescription')}}</label>
        <span class="field">
            <textarea name="mdescription" class="form-control" rows="5" >{{@$el->translate($l->lang)->mdescription}}</textarea>
        </span>
    </p>

    <p>
        <label>{{trans('labels.mkeys')}}</label>
        <span class="field">
            <textarea name="mkeys" class="form-control" rows="2" >{{@$el->translate($l->lang)->mkeys}}</textarea>
        </span>
    </p>
                                    
    <p class="stdformbutton">
        <button type="submit" class="btn btn-primary">{{trans('labels.save')}}</button>
        <button class="btn btn-default close-upload-meta">{{trans('labels.close')}}</button>
    </p>
</form>