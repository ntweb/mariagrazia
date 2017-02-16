@extends('lab.user.default')

@section('content')

    <h4 class="widgettitle">{{trans('labels.list')}}</h4>
    @if(count($arrElements))

    <table class="table table-striped responsive">
        <thead>
            <tr>
                <th class="center"><i class="fa fa-power-off" aria-hidden="true"></i></th>
                <th class="center"><i class="fa fa-user-circle-o" aria-hidden="true"></i></th>
                <th class="center"><i class="fa fa-pencil" aria-hidden="true"></i></th>
                <th class="center"><i class="fa fa-unlock-alt" aria-hidden="true"></i></th>
                <th>ID</th>
                <th>{{trans('labels.title')}}</th>
                <th>{{trans('labels.email')}}</th>
                <th>{{trans('labels.created_at')}}</th>
                <th>{{trans('labels.updated_at')}}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($arrElements as $el)
            <tr>
                <td class="center">
                    <a href="javascript:void(0);" class="change-flag {{$active = $el->active ? 'colorGreen' : 'colorRed'}}" data-route="{{action('Lab\UserController@changeFlag', array($el->id, 'active'))}}">                        
                        <i class="fa fa-circle tip" aria-hidden="true" data-placement="top" data-original-title="{{trans('labels.active')}} ?"></i>
                    </a>
                </td>
                <td class="center">
                    <a href="javascript:void(0);" class="change-flag {{$administrator = $el->administrator ? 'colorGreen' : 'colorRed'}}" data-route="{{action('Lab\UserController@changeFlag', array($el->id, 'administrator'))}}">                        
                        <i class="fa fa-circle tip" aria-hidden="true" data-placement="top" data-original-title="{{trans('labels.administrator')}} ?"></i>
                    </a>
                </td>                
                <td class="center">
                    <a href="javascript:void(0);" class="change-flag {{$editor = $el->editor ? 'colorGreen' : 'colorRed'}}" data-route="{{action('Lab\UserController@changeFlag', array($el->id, 'editor'))}}">                        
                        <i class="fa fa-circle tip" aria-hidden="true" data-placement="top" data-original-title="{{trans('labels.editor')}} ?"></i>
                    </a>
                </td>
                <td class="center">
                    <a href="javascript:void(0);" class="change-flag {{$limited = $el->limited ? 'colorGreen' : 'colorRed'}}" data-route="{{action('Lab\UserController@changeFlag', array($el->id, 'limited'))}}">                        
                        <i class="fa fa-circle tip" aria-hidden="true" data-placement="top" data-original-title="{{trans('labels.limited')}} ?"></i>
                    </a>
                </td>
                <td>{{$el->id}}</td>
                <td>{{$el->name}} {{$el->lastname}}</td>
                <td>{{$el->email}}</td>
                <td>{{date($default_lang->datetime, strtotime($el->created_at))}}</td>
                <td>{{date($default_lang->datetime, strtotime($el->updated_at))}}</td>
                <td class="right">
                    <div class="btn-group btn-group-xs">
                        <button href="javascript:void(0);" class="btn btn-primary get-html" data-route="{{action('Lab\UserController@edit', array($el->id))}}"><i class="fa fa-fw fa-pencil" aria-hidden="true"></i></button>
                    </div>                                
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- pagination -->
    @include('lab.user.pagination.default')

    @else

    <div class="alert alert-block">
        <h4>Ops!</h4>
        <p>{{trans('labels.no_element_found')}}</p>
    </div>

    @endif

@endsection