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
        <label>{{trans('lab.price')}}</label>
        <div class="field">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-euro" aria-hidden="true"></i></span>
                <input type="text" name="price" class="form-control" value="{{$el->price}}" />                        
            </div>
        </div>
    </p>     

    @if($el->type == 'color')
    <p>
        <label>{{trans('lab.color')}}</label>
        <div class="field">
            <input type="hidden" id="colorpicker" name="color" class="form-control input-sm" value="{{$el->color}}">
            <span id="colorSelector" class="colorselector"><span></span></span>        
        </div>
    </p>     
    @endif

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