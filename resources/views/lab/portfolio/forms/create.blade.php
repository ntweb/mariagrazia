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
            <label>{{trans('labels.businessname')}}</label>
            <span class="field">
                <input type="text" name="businessname" class="form-control" />
            </span>
        </p>

        <p>
            <label>{{trans('labels.url')}}</label>
            <span class="field">
                <input type="text" name="site" class="form-control" />
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

        <p>
            <label>{{trans('labels.description')}}</label>
            <span class="field">
                <textarea name="description" class="wysiwyg_editor">{{@$el->translate($l->lang)->description}}</textarea>
            </span>
        </p>

        <p>
            <label>{{trans('labels.google-preview')}}</label>
            <div class="field">
                <div id="snippet-{{$l->lang}}"></div>
            </div>
        </p>

        <p>
            <label>{{trans('labels.mtitle')}}</label>
            <span class="field">
                <input type="text" name="mtitle" class="form-control google-snippet" id="mtitle-{{$l->lang}}" data-v="{{$l->lang}}" value="{{@$el->translate($l->lang)->mtitle}}" />
            </span>
        </p>

        <p>
            <label>{{trans('labels.mdescription')}}</label>
            <span class="field">
                <textarea name="mdescription" maxlength="250" class="form-control google-snippet" id="mdescription-{{$l->lang}}" data-v="{{$l->lang}}" rows="5" >{{@$el->translate($l->lang)->mdescription}}</textarea>
            </span>
        </p>

        <p>
            <label>{{trans('labels.murl')}}</label>
            <span class="field">
                <input type="text" name="murl" class="form-control google-snippet" id="murl-{{$l->lang}}" data-v="{{$l->lang}}" value="{{@$el->translate($l->lang)->murl}}" />
            </span>
        </p>

        <p>
            <label>{{trans('labels.mkeys')}}</label>
            <span class="field">
                <textarea name="mkeys" class="form-control google-snippet" rows="2" >{{@$el->translate($l->lang)->mkeys}}</textarea>
            </span>
        </p>

    @endif
                                    
    <p class="stdformbutton">
        <button type="submit" class="btn btn-primary">{{trans('labels.save')}}</button>
    </p>
</form>