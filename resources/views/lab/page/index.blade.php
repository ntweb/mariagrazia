@extends('lab.page.default')

@section('content')

    <h4 class="widgettitle">Table Bordered</h4>
    @if(count($arrElements))

    <table class="table table-striped responsive">
        <thead>
            <tr>
                <th class="center">{{trans('labels.active')}}</th>
                <th>ID</th>
                <th>{{trans('labels.title')}}</th>
                <th>{{trans('labels.module')}}</th>
                <th>{{trans('labels.created_at')}}</th>
                <th>{{trans('labels.updated_at')}}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($arrElements as $el)
            <tr>
                <td class="center">
                    <a href="javascript:void(0);" class="change-flag {{$active = $el->active ? 'colorGreen' : 'colorRed'}}" data-route="{{action('Lab\PageController@changeFlag', array($el->id, 'active'))}}">                        
                        <i class="fa fa-circle" aria-hidden="true"></i>
                    </a>
                </td>
                <td>{{$el->id}}</td>
                <td>{{$el->title}}</td>
                <td>{{$el->module}}</td>
                <td>{{date($default_lang->datetime, strtotime($el->created_at))}}</td>
                <td>{{date($default_lang->datetime, strtotime($el->updated_at))}}</td>
                <td class="right">
                    <div class="btn-group btn-group-xs">
                        <button href="javascript:void(0);" class="btn btn-primary get-html" data-route="{{action('Lab\PageController@edit', array($el->id))}}"><i class="fa fa-fw fa-pencil" aria-hidden="true"></i></button>
                        <button href="javascript:void(0);" class="btn btn-danger delete-json" data-route="{{action('Lab\PageController@destroy', array($el->id))}}" data-token="{{ csrf_token() }}" data-callback="$(btn).closest('tr').remove()" data-confirm="{{trans('labels.confirm-delete')}}"><i class="fa fa-fw fa-trash" aria-hidden="true"></i></button>
                    </div>                                
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- pagination -->
    @include('lab.page.pagination.default')

    @else

    <div class="alert alert-block">
        <h4>Ops!</h4>
        <p>{{trans('labels.no_element_found')}}</p>
    </div>

    @endif

@endsection