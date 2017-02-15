<form class="stdform stdform2 ns" data-route="{{$route_registry}}" data-method='PUT' >
{!! csrf_field() !!}    {{-- token --}}

    <p>
        <label>{{trans('labels.name')}}</label>
        <span class="field">
            <input type="text" name="name" class="form-control" value="{{$el->name}}" />
        </span>
    </p>

    <p>
        <label>{{trans('labels.lastname')}}</label>
        <span class="field">
            <input type="text" name="lastname" class="form-control" value="{{$el->lastname}}" />
        </span>
    </p>
                                    
    <p>
        <label>{{trans('labels.role')}}</label>
        <span class="field">
            <input type="text" name="role" class="form-control" value="{{$el->role}}" />
        </span>
    </p>
                                    
    <p>
        <label>{{trans('labels.email')}}</label>
        <span class="field">
            <input type="text" name="email" class="form-control" value="{{$el->email}}" />
        </span>
    </p>
                                    
    <p>
        <label>{{trans('labels.telephone')}}</label>
        <span class="field">
            <input type="text" name="telephone" class="form-control" value="{{$el->telephone}}" />
        </span>
    </p>
                                    
    <p>
        <label>{{trans('labels.cell')}}</label>
        <span class="field">
            <input type="text" name="cell" class="form-control" value="{{$el->cell}}" />
        </span>
    </p>
                                    
    <p>
        <label>{{trans('labels.fb')}}</label>
        <span class="field">
            <input type="text" name="fb" class="form-control" value="{{$el->fb}}" />
        </span>
    </p>
                                    
    <p>
        <label>{{trans('labels.tw')}}</label>
        <span class="field">
            <input type="text" name="tw" class="form-control" value="{{$el->tw}}" />
        </span>
    </p>
                                    
    <p>
        <label>{{trans('labels.gp')}}</label>
        <span class="field">
            <input type="text" name="gp" class="form-control" value="{{$el->gp}}" />
        </span>
    </p>
                                    
    <p>
        <label>{{trans('labels.ln')}}</label>
        <span class="field">
            <input type="text" name="ln" class="form-control" value="{{$el->ln}}" />
        </span>
    </p>
                                    
    <p class="stdformbutton">
        <button type="submit" class="btn btn-primary">{{trans('labels.save')}}</button>
    </p>
</form>