<form class="stdform stdform2 ns" data-route="{{$route_registry}}" data-method='PUT' >
{!! csrf_field() !!}    {{-- token --}}

    <p>
        <label>{{trans('lab.name')}}</label>
        <span class="field">
            <input type="text" name="name" class="form-control" value="{{$el->name}}" />
        </span>
    </p>

    <p>
        <label>{{trans('lab.lastname')}}</label>
        <span class="field">
            <input type="text" name="lastname" class="form-control" value="{{$el->lastname}}" />
        </span>
    </p>
                                    
    <p>
        <label>{{trans('lab.role')}}</label>
        <span class="field">
            <input type="text" name="role" class="form-control" value="{{$el->role}}" />
        </span>
    </p>
                                    
    <p>
        <label>{{trans('lab.email')}}</label>
        <span class="field">
            <input type="text" name="email" class="form-control" value="{{$el->email}}" />
        </span>
    </p>
                                    
    <p>
        <label>{{trans('lab.telephone')}}</label>
        <span class="field">
            <input type="text" name="telephone" class="form-control" value="{{$el->telephone}}" />
        </span>
    </p>
                                    
    <p>
        <label>{{trans('lab.cell')}}</label>
        <span class="field">
            <input type="text" name="cell" class="form-control" value="{{$el->cell}}" />
        </span>
    </p>
                                    
    <p>
        <label>{{trans('lab.fb')}}</label>
        <span class="field">
            <input type="text" name="fb" class="form-control" value="{{$el->fb}}" />
        </span>
    </p>
                                    
    <p>
        <label>{{trans('lab.tw')}}</label>
        <span class="field">
            <input type="text" name="tw" class="form-control" value="{{$el->tw}}" />
        </span>
    </p>
                                    
    <p>
        <label>{{trans('lab.gp')}}</label>
        <span class="field">
            <input type="text" name="gp" class="form-control" value="{{$el->gp}}" />
        </span>
    </p>
                                    
    <p>
        <label>{{trans('lab.ln')}}</label>
        <span class="field">
            <input type="text" name="ln" class="form-control" value="{{$el->ln}}" />
        </span>
    </p>
                                    
    <p class="stdformbutton">
        <button type="submit" class="btn btn-primary">{{trans('lab.save')}}</button>
    </p>
</form>