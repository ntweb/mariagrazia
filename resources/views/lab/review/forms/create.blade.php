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
            <label>{{trans('lab.title')}}</label>
            <span class="field">
                <input type="text" name="title" class="form-control" />
            </span>
        </p>

    @else

        {{-- editing --}}
        <p>
            <label>{{trans('lab.title')}}</label>
            <span class="field">
                <input type="text" name="title" class="form-control" value="{{@$el->title}}" />
            </span>
        </p>

        <p>
            <label>{{trans('lab.name')}}</label>
            <span class="field">
                <input type="text" name="name" class="form-control" value="{{@$el->name}}" />
            </span>
        </p>

        <p>
            <label>{{trans('lab.email')}}</label>
            <span class="field">
                <input type="text" name="email" class="form-control" value="{{@$el->email}}" />
            </span>
        </p>

        <p>
            <label>{{trans('lab.site')}}</label>
            <span class="field">
                <input type="text" name="site" class="form-control" value="{{@$el->site}}" />
            </span>
        </p>

        <p>
            <label>{{trans('lab.vote')}}</label>
            <span class="field">
                <input type="text" name="vote" class="form-control" value="{{@$el->vote}}" />
            </span>
        </p>

        <p>
            <label>{{trans('lab.description')}}</label>
            <div class="field">
                <div class="alert alert-info">                    
                    {!! @$el->description !!}
                </div>
            </div>
        </p>

        <p>
            <label>{{trans('lab.answer')}}</label>
            <span class="field">
                <textarea name="answer" class="wysiwyg_editor">{{@$el->answer}}</textarea>
            </span>
        </p>

    @endif
                                    
    <p class="stdformbutton">
        <button type="submit" class="btn btn-primary">{{trans('lab.save')}}</button>
    </p>
</form>