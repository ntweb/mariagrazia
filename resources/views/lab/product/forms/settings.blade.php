<form class="stdform stdform2 ns" data-route="{{$route_settings}}" data-method='PUT' >
{!! csrf_field() !!}    {{-- token --}}

    <p>
        <label>{{trans('lab.subcategory')}}</label>
        <span class="field">
            <select name="type" class="form-control">
                @foreach ($arrType as $t)
                    <option value="{{$t->id}}" @if($el->type == $t->id) selected="selected" @endif >{{$t->title}}</option>
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
        <label>{{trans('lab.price')}}</label>
        <div class="field">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-euro" aria-hidden="true"></i></span>
                <input type="text" name="price" class="form-control" value="{{$el->price}}" />                        
            </div>
        </div>
    </p>    
                                    
    <p>
        <label>{{trans('lab.price_discount')}}</label>
        <div class="field">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-euro" aria-hidden="true"></i></span>
                <input type="text" name="price_discount" class="form-control" value="{{$el->price_discount}}" />                        
            </div>
        </div>
    </p>    
                                    
    <p>
        <label>{{trans('lab.tax')}}</label>
        <div class="field">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-percent" aria-hidden="true"></i></span>
                <input type="text" name="tax" class="form-control" value="{{$el->tax}}" />                        
            </div>
        </div>
    </p>    
                                    
    <p>
        <label>{{trans('lab.homepage')}}</label>
        <div class="field">
            <select name="homepage" class="uniformselect">
                <option value="0" @if(!$el->homepage) selected="selected" @endif>{{trans('lab.no')}}</option>
                <option value="1" @if($el->homepage) selected="selected" @endif>{{trans('lab.yes')}}</option>
            </select>        
        </div>
    </p>

    <p>
        <label>{{trans('lab.new')}}</label>
        <div class="field">
            <select name="new" class="uniformselect">
                <option value="0" @if(!$el->new) selected="selected" @endif>{{trans('lab.no')}}</option>
                <option value="1" @if($el->new) selected="selected" @endif>{{trans('lab.yes')}}</option>
            </select>        
        </div>
    </p>

    <p>
        <label>{{trans('lab.discount')}}</label>
        <div class="field">
            <select name="discount" class="uniformselect">
                <option value="0" @if(!$el->discount) selected="selected" @endif>{{trans('lab.no')}}</option>
                <option value="1" @if($el->discount) selected="selected" @endif>{{trans('lab.yes')}}</option>
            </select>        
        </div>
    </p>

    <p>
        <label>{{trans('lab.active')}}</label>
        <div class="field">
            <select name="active" class="uniformselect">
                <option value="0" @if(!$el->active) selected="selected" @endif>{{trans('lab.no')}}</option>
                <option value="1" @if($el->active) selected="selected" @endif>{{trans('lab.yes')}}</option>
            </select>        
        </div>
    </p>
                                    
    <p class="stdformbutton">
        <button type="submit" class="btn btn-primary">{{trans('lab.save')}}</button>
    </p>
</form>