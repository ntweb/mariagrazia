    <div class="row">
        <div class="col-md-6">
            
            {{-- list of uploaded files --}}
            <table class="table responsive">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th style="width: 50%;">{{trans('labels.filename')}}</th>
                        <th>{{trans('labels.size')}}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="sortable" data-route="{{action('Lab\OrderController@update', array($table))}}" data-token="{{ csrf_token() }}">
                    @if (count($arrUploaded))
                    @foreach ($arrUploaded as $el)
                    <tr id="item-{{$el->id}}">
                        <td class="handle"><i class="fa fa-sort" aria-hidden="true"></i></td>
                        <td class="center">                            
                            <a href="javascript:void(0);" class="change-flag {{$active = $el->active ? 'colorGreen' : 'colorRed'}}" data-route="{{action('Lab\UploadController@changeFlag', array($el->id, 'active'))}}">                        
                                <i class="fa fa-circle" aria-hidden="true"></i>
                            </a>
                        </td>                    
                        <td>
                            <a href="{{url('media/'.$el->uploadfolder.'/'.$el->id_el.'/mm/'.$el->filename)}}" @if($el->img) class="preview" @endif title="{{$el->filename}}" target="_blank">
                            {{$el->filename}}
                            </a>
                        </td>
                        <td>{{$el->size}}</td>
                        <td class="right">
                            <div class="btn-group btn-group-xs">
                                <button href="javascript:void(0);" class="get-html btn btn-primary" data-route="{{action('Lab\UploadController@edit', array($id))}}" data-container="#upload-meta" data-callback="$('#upload-plugin').hide(0)"><i class="fa fa-fw fa-pencil" aria-hidden="true"></i></button>
                                <button href="javascript:void(0);" class="btn btn-danger delete-json" data-route="{{action('Lab\UploadController@delete', array($el->id))}}" data-token="{{ csrf_token() }}" data-callback="btn.closest('tr').remove()"><i class="fa fa-fw fa-trash" aria-hidden="true"></i></button>
                            </div>                            
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="3"><p class="alert alert-warning">{{trans('labels.no_files_uploaded')}}</p></td>
                    </tr>
                    @endif
                </tbody>
            </table>

        </div>
        <div class="col-md-6">
            
            {{-- meta plugin --}}
            <div id="upload-meta"></div>

            {{-- upload plugin --}}
            <div id="upload-plugin">                
            @include('lab.upload.forms.attachments')
            </div>

        </div>
    </div>