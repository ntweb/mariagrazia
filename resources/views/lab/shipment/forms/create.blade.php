<form class="stdform stdform2 ns" 
    data-route="{{$route}}" 
        @if(isset($el)) 
            data-method='PUT' 
        @else 
            data-callback="getHtml(param)" 
        @endif
>

{!! csrf_field() !!}    {{-- token --}}
@if (isset($l))         {{-- locale --}}
<input type="hidden" name="lang" value="{{$l->lang}}">
@endif

    @if(!isset($el))
        
        {{-- creation --}}
        <p>
            <label>{{trans('labels.title')}}</label>
            <span class="field">
                <input type="text" name="title" class="form-control" />
            </span>
        </p>

    @else

        {{-- editing --}}
        <p>
            <label>{{trans('labels.title')}}</label>
            <span class="field">
                <input type="text" name="title" class="form-control" value="{{@$el->translate($l->lang)->title}}" />
            </span>
        </p>

        <p>
            <label>{{trans('labels.abstract')}}</label>
            <span class="field">
                <textarea name="abstract" class="form-control" rows="5" maxlength="250" >{{@$el->translate($l->lang)->abstract}}</textarea>
            </span>
        </p>        

    @endif
                                    
    <p class="stdformbutton">
        <button type="submit" class="btn btn-primary">{{trans('labels.save')}}</button>
    </p>
</form>