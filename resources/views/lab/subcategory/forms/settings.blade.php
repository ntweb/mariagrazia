<form class="stdform stdform2 ns" data-route="{{$route_settings}}" data-method='PUT' >
{!! csrf_field() !!}    {{-- token --}}

    <p>
        <label>{{trans('labels.category')}}</label>
        <span class="field">
            <select name="type" class="form-control">
                @foreach ($arrType as $t)
                    <option value="{{$t->id}}" @if($el->type == $t->id) selected="selected" @endif >{{$t->title}}</option>
                @endforeach
            </select>
        </span>
    </p>
                                    
    <p>
        <label>{{trans('labels.active')}}</label>
        <div class="field">
            <select name="active" class="uniformselect">
                <option value="0" @if(!$el->active) selected="selected" @endif>{{trans('labels.no')}}</option>
                <option value="1" @if($el->active) selected="selected" @endif>{{trans('labels.yes')}}</option>
            </select>        
            <br><br>
            <div class="alert alert-warning">
                Attenzione! Disattivando la sottocategoria verranno disattivati in automatico i prodotti appartenenti!
            </div>
        </div>
    </p>
                                    
    <p class="stdformbutton">
        <button type="submit" class="btn btn-primary">{{trans('labels.save')}}</button>
    </p>
</form>