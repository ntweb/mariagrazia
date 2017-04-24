<table class="table responsive">
    <thead>
        <tr>
            <th></th>
            <th>{{trans('lab.filename')}}</th>
            <th>{{trans('lab.size')}}</th>
            <th style="width: 50%;"></th>
        </tr>
    </thead>
    <tbody id="filelist" data-route="{{action('Lab\UploadController@multiupload', array($id, $uploadfolder))}}" data-token="{{ csrf_token() }}" data-reload="{{action('Lab\UploadController@index', array($id, $uploadfolder))}}">
        <tr>
            <td colspan="4"><p class="alert alert-warning">{{trans('lab.no_files_to_upload')}}</p></td>
        </tr>
    </tbody>
</table>
<br><br>
<div id="container">
    <button class="btn btn-default btn-sm" id="browse" href="javascript:;">[{{{trans('lab.browse')}}}...]</button>
    <button class="btn btn-primary btn-sm" id="start-upload" href="javascript:;">[{{trans('lab.upload')}}]</button>
</div>