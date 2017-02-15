<form class="stdform stdform2 ns" data-route="{{$route_settings}}" data-method='PUT' >
{!! csrf_field() !!}    {{-- token --}}

    <p>
        <label>{{trans('labels.type')}}</label>
        <span class="field">
            <select name="type" class="form-control">
                @foreach ($arrType as $t)
                    <option value="{{$t}}" @if($el->type == $t) selected="selected" @endif >{{$t}}</option>
                @endforeach
            </select>
        </span>
    </p>

    <p>
        <label>{{trans('labels.homepage')}}</label>
        <span class="field">
            <select name="homepage" class="uniformselect">
                <option value="0" @if(!$el->homepage) selected="selected" @endif>{{trans('labels.no')}}</option>
                <option value="1" @if($el->homepage) selected="selected" @endif>{{trans('labels.yes')}}</option>
            </select>        
        </span>
    </p>
                                    
    <p>
        <label>{{trans('labels.active')}}</label>
        <span class="field">
            <select name="active" class="uniformselect">
                <option value="0" @if(!$el->active) selected="selected" @endif>{{trans('labels.no')}}</option>
                <option value="1" @if($el->active) selected="selected" @endif>{{trans('labels.yes')}}</option>
            </select>        
        </span>
    </p>
                                    
    <p class="stdformbutton">
        <button type="submit" class="btn btn-primary">{{trans('labels.save')}}</button>
    </p>
</form>