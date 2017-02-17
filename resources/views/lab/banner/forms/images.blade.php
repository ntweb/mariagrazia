<form class="stdform stdform2 ns" enctype="multipart/form-data" data-route="{{action('Lab\UploadController@image', array($el->id, $table, $uploadfolder))}}" >
{!! csrf_field() !!}    {{-- token --}}

    <p>
        <label>{{trans('labels.image')}}</label>
        <div class="field">
            <input type="file" name="img" accept=".jpg,.png,.gif">
            @if ($el->img)
            <a href="{{url('media/'.$el->uploadfolder.'/'.$el->id.'/'.$el->img)}}" class="preview" target="_blank">preview</a>
            &nbsp;&nbsp;&nbsp;
            <a href="javascript:void(0);" class="colorRed get-json" data-route="{{action('Lab\BannerController@deleteImg', array($el->id, 'img'))}}"><i class="fa fa-trash-o" aria-hidden="true"></i> delete</a>
            @endif
        </div>
    </p>

    <p>
        <label>{{trans('labels.background')}}</label>
        <div class="field">
            <input type="file" name="background" accept=".jpg,.png,.gif">
            @if ($el->background)
            <a href="{{url('media/'.$el->uploadfolder.'/'.$el->id.'/'.$el->background)}}" class="preview" target="_blank">preview</a>
			&nbsp;&nbsp;&nbsp;
            <a href="javascript:void(0);" class="colorRed get-json" data-route="{{action('Lab\BannerController@deleteImg', array($el->id, 'background'))}}"><i class="fa fa-trash-o" aria-hidden="true"></i> delete</a>
            @endif
        </div>
    </p>
                                    
    <p class="stdformbutton">
        <button type="submit" class="btn btn-primary">{{trans('labels.save')}}</button>
    </p>
</form>