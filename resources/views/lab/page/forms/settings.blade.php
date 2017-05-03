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
        <label>{{trans('lab.module')}}</label>
        <span class="field">
            <input type="text" name="module" class="form-control" value="{{$el->module}}" />     
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

    <p>
        <label>{{trans('lab.sitemap_priority_frequency')}}</label>
        <div class="field">
            <select name="priority" class="uniformselect">
                <option value="0.0" @if($el->priority == '0.0') selected="selected" @endif>0.0</option>
                <option value="0.1" @if($el->priority == '0.1') selected="selected" @endif>0.1</option>
                <option value="0.2" @if($el->priority == '0.2') selected="selected" @endif>0.2</option>
                <option value="0.3" @if($el->priority == '0.3') selected="selected" @endif>0.3</option>
                <option value="0.4" @if($el->priority == '0.4') selected="selected" @endif>0.4</option>
                <option value="0.5" @if($el->priority == '0.5') selected="selected" @endif>0.5</option>
                <option value="0.6" @if($el->priority == '0.6') selected="selected" @endif>0.6</option>
                <option value="0.7" @if($el->priority == '0.7') selected="selected" @endif>0.7</option>
                <option value="0.8" @if($el->priority == '0.8') selected="selected" @endif>0.8</option>
                <option value="0.9" @if($el->priority == '0.9') selected="selected" @endif>0.9</option>
                <option value="1.0" @if($el->priority == '1.0') selected="selected" @endif>1.0</option>
            </select>        
            <select name="changefreq" class="uniformselect">
                <option value="always" @if($el->changefreq == 'always') selected="selected" @endif>always</option>
                <option value="hourly" @if($el->changefreq == 'hourly') selected="selected" @endif>hourly</option>
                <option value="daily" @if($el->changefreq == 'daily') selected="selected" @endif>daily</option>
                <option value="weekly" @if($el->changefreq == 'weekly') selected="selected" @endif>weekly</option>
                <option value="monthly" @if($el->changefreq == 'monthly') selected="selected" @endif>monthly</option>
                <option value="yearly" @if($el->changefreq == 'yearly') selected="selected" @endif>yearly</option>
                <option value="never" @if($el->changefreq == 'never') selected="selected" @endif>never</option>                
            </select>        
        </div>
    </p>    
                                    
    <p class="stdformbutton">
        <button type="submit" class="btn btn-primary">{{trans('lab.save')}}</button>
    </p>
</form>