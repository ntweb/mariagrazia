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
        <label>{{trans('labels.amount')}}</label>
        <div class="field">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-euro" aria-hidden="true"></i></span>
                <input type="text" name="amount" class="form-control" value="{{$el->amount}}" />                        
            </div>
        </div>
    </p>    

    <p>
        <label>{{trans('labels.amount_type')}}</label>
        <div class="field">
            <select name="amount_type" class="form-control">               
                <option value="value" @if($el->amount_type == 'value') selected="selected" @endif >value</option>                
                <option value="percent" @if($el->amount_type == 'percent') selected="selected" @endif >percent</option>
            </select>
        </div>
    </p>    
                                    
    <p>
        <label>{{trans('labels.tax')}}</label>
        <div class="field">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-percent" aria-hidden="true"></i></span>
                <input type="text" name="tax" class="form-control" value="{{$el->tax}}" />                        
            </div>
        </div>
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