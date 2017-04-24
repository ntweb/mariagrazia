<form class="stdform stdform2 ns" data-route="{{$route_settings}}" data-method='PUT' >
{!! csrf_field() !!}    {{-- token --}}

    <p>
        <label>{{trans('lab.type')}}</label>
        <span class="field">
            <select name="type" class="form-control">
                @foreach ($arrType as $t)
                    <option value="{{$t}}" @if($el->type == $t) selected="selected" @endif >{{$t}}</option>
                @endforeach
            </select>
        </span>
    </p> 

    <p>
        <label>{{trans('lab.url')}}</label>
        <span class="field">
            <input type="text" name="url" class="form-control" value="{{$el->url}}" />
        </span>
    </p>

    <p>
        <label>{{trans('lab.begin')}}</label>
        <span class="field">
            <input type="text" name="begin" class="form-control datepicker" data-format="{{$default_lang['date_ui']}}" placeholder="{{$default_lang['date_ui']}}" value="@if($el->begin) {{date($default_lang['date'], strtotime($el->begin))}} @endif" />
        </span>
    </p>

    <p>
        <label>{{trans('lab.homepage')}}</label>
        <span class="field">
            <select name="homepage" class="uniformselect">
                <option value="0" @if(!$el->homepage) selected="selected" @endif>{{trans('lab.no')}}</option>
                <option value="1" @if($el->homepage) selected="selected" @endif>{{trans('lab.yes')}}</option>
            </select>        
        </span>
    </p>
                                    
    <p>
        <label>{{trans('lab.active')}}</label>
        <span class="field">
            <select name="active" class="uniformselect">
                <option value="0" @if(!$el->active) selected="selected" @endif>{{trans('lab.no')}}</option>
                <option value="1" @if($el->active) selected="selected" @endif>{{trans('lab.yes')}}</option>
            </select>        
        </span>
    </p>
                                    
    <p class="stdformbutton">
        <button type="submit" class="btn btn-primary">{{trans('lab.save')}}</button>
    </p>
</form>