<form class="stdform stdform2 ns" data-route="{{$route}}" data-method='PUT'>
{!! csrf_field() !!}    {{-- token --}}
@if (isset($l))         {{-- locale --}}
<input type="hidden" name="lang" value="{{$localeCode}}">
@endif

    {{-- editing --}}
    <p>
        <label>{{trans('lab.mtitle')}}</label>
        <span class="field">
            <input type="text" name="mtitle" class="form-control" value="{{@$el->translate($localeCode)->mtitle}}" />
        </span>
    </p>

    <p>
        <label>{{trans('lab.mdescription')}}</label>
        <span class="field">
            <textarea name="mdescription" maxlength="250" class="form-control" rows="5" >{{@$el->translate($localeCode)->mdescription}}</textarea>
        </span>
    </p>

    <p>
        <label>{{trans('lab.mkeys')}}</label>
        <span class="field">
            <textarea name="mkeys" class="form-control" rows="2" >{{@$el->translate($localeCode)->mkeys}}</textarea>
        </span>
    </p>
                                    
    <p class="stdformbutton">
        <button type="submit" class="btn btn-primary">{{trans('lab.save')}}</button>
        <button class="btn btn-default close-upload-meta">{{trans('lab.close')}}</button>
    </p>
</form>