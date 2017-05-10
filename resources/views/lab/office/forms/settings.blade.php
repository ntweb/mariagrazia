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
        <label>{{trans('lab.city')}}</label>
        <span class="field">
            <input type="text" name="city" class="form-control" value="{{@$el->city}}" />
        </span>
    </p>    

    <p>
        <label>{{trans('lab.address')}}</label>
        <span class="field">
            <input type="text" name="address" class="form-control" value="{{@$el->address}}" />
        </span>
    </p>    

    <p>
        <label>{{trans('lab.zipcode')}}</label>
        <span class="field">
            <input type="text" name="zipcode" class="form-control" value="{{@$el->zipcode}}" />
        </span>
    </p>    

    <p>
        <label>{{trans('lab.telephone')}}</label>
        <span class="field">
            <input type="text" name="telephone" class="form-control" value="{{@$el->telephone}}" />
        </span>
    </p>

    <p>
        <label>{{trans('lab.fax')}}</label>
        <span class="field">
            <input type="text" name="fax" class="form-control" value="{{@$el->fax}}" />
        </span>
    </p>

    <p>
        <label>{{trans('lab.email')}}</label>
        <span class="field">
            <input type="text" name="email" class="form-control" value="{{@$el->email}}" />
        </span>
    </p>

    <p>
        <label>{{trans('lab.latitude')}}</label>
        <span class="field">
            <input type="text" name="latitude" class="form-control" value="{{@$el->latitude}}" />
        </span>
    </p>

    <p>
        <label>{{trans('lab.longitude')}}</label>
        <span class="field">
            <input type="text" name="longitude" class="form-control" value="{{@$el->longitude}}" />
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