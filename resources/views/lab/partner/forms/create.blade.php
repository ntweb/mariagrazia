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
<input type="hidden" name="lang" value="{{$localeCode}}">
@endif

    @if(!isset($el))
        
        {{-- creation --}}
        <p>
            <label>{{trans('lab.businessname')}}</label>
            <span class="field">
                <input type="text" name="businessname" class="form-control" />
            </span>
        </p>

    @else

        {{-- editing --}}
        <p>
            <label>{{trans('lab.title')}}</label>
            <span class="field">
                <input type="text" name="title" class="form-control" value="{{@$el->translate($localeCode)->title}}" />
            </span>
        </p>

        <p>
            <label>{{trans('lab.description')}}</label>
            <span class="field">
                <textarea name="description" class="wysiwyg_editor">{{@$el->translate($localeCode)->description}}</textarea>
            </span>
        </p>

        <p>
            <label>{{trans('lab.google-preview')}}</label>
            <div class="field">
                <div id="snippet-{{$localeCode}}"></div>
            </div>
        </p>

        <p>
            <label>{{trans('lab.mtitle')}}</label>
            <span class="field">
                <input type="text" name="mtitle" class="form-control google-snippet" id="mtitle-{{$localeCode}}" data-v="{{$localeCode}}" value="{{@$el->translate($localeCode)->mtitle}}" />
            </span>
        </p>

        <p>
            <label>{{trans('lab.mdescription')}}</label>
            <span class="field">
                <textarea name="mdescription" maxlength="250" class="form-control google-snippet" id="mdescription-{{$localeCode}}" data-v="{{$localeCode}}" rows="5" >{{@$el->translate($localeCode)->mdescription}}</textarea>
            </span>
        </p>

        <p>
            <label>{{trans('lab.murl')}}</label>
            <span class="field">
                <input type="text" name="murl" class="form-control google-snippet" id="murl-{{$localeCode}}" data-v="{{$localeCode}}" value="{{@$el->translate($localeCode)->murl}}" />
            </span>
        </p>

        <p>
            <label>{{trans('lab.mkeys')}}</label>
            <span class="field">
                <textarea name="mkeys" class="form-control google-snippet" rows="2" >{{@$el->translate($localeCode)->mkeys}}</textarea>
            </span>
        </p>

    @endif
                                    
    <p class="stdformbutton">
        <button type="submit" class="btn btn-primary">{{trans('lab.save')}}</button>
    </p>
</form>