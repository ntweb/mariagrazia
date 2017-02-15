<form class="stdform stdform2 ns" data-route="{{$route_registry}}" data-method='PUT' >
{!! csrf_field() !!}    {{-- token --}}

    <p>
        <label>{{trans('labels.businessname')}}</label>
        <span class="field">
            <input type="text" name="businessname" class="form-control" value="{{$el->businessname}}" />
        </span>
    </p>

    <p>
        <label>{{trans('labels.email')}}</label>
        <span class="field">
            <input type="text" name="email" class="form-control" value="{{$el->email}}" />
        </span>
    </p>
                                    
    <p>
        <label>{{trans('labels.site')}}</label>
        <span class="field">
            <input type="text" name="site" class="form-control" value="{{$el->site}}" />
        </span>
    </p>
                                    
    <p class="stdformbutton">
        <button type="submit" class="btn btn-primary">{{trans('labels.save')}}</button>
    </p>
</form>