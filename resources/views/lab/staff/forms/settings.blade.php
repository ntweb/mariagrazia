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
        <label>{{trans('lab.code')}}</label>
        <span class="field">
            <input type="text" name="code" class="form-control" value="{{$el->code}}" />
        </span>
    </p>    

    <p>
        <label>{{trans('lab.office')}}</label>
        <span class="field">
            <select name="office_id" class="form-control">
                <option value="0" >nd</option>
                @foreach ($arrOffices as $o)
                    <option value="{{$o->id}}" @if($o->id == $el->office_id) selected="selected" @endif >{{$o->title}}</option>
                @endforeach
            </select>
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