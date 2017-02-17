@extends('lab.review.default')

@section('content')

    <div class="headtitle">
        <div class="btn-group">
            <button data-toggle="dropdown" class="btn dropdown-toggle">{{request('type', trans('labels.all'))}} <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="javascript:void(0);" class="get-html" data-route="{{action('Lab\ReviewController@index')}}">{{trans('labels.all')}}</a></li>
                <li class="divider"></li>
                @foreach ($arrType as $t)
                <li><a href="javascript:void(0);" class="get-html" data-route="{{action('Lab\ReviewController@index')}}?type={{$t}}">{{$t}}</a></li>
                @endforeach
            </ul>
          </div>
        <h4 class="widgettitle title-primary">{{trans('labels.list')}}</h4>
    </div>

    @if(count($arrElements))

    <table class="table table-striped responsive">
        <thead>
            <tr>
                <th class="center"><i class="fa fa-power-off" aria-hidden="true"></i></th>
                <th class="center"><i class="fa fa-home" aria-hidden="true"></i></th>
                <th>ID</th>
                <th>{{trans('labels.title')}}</th>
                <th>{{trans('labels.name')}}</th>                                
                <th>{{trans('labels.type')}}</th>                                
                <th>{{trans('labels.element')}}</th>                                
                <th>{{trans('labels.created_at')}}</th>
                <th>{{trans('labels.updated_at')}}</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="sortable" data-route="{{action('Lab\OrderController@update', array($table))}}" data-token="{{ csrf_token() }}">
            @foreach ($arrElements as $el)
            <tr>
                <td class="center">
                    <a href="javascript:void(0);" class="change-flag {{$active = $el->active ? 'colorGreen' : 'colorRed'}}" data-route="{{action('Lab\ReviewController@changeFlag', array($el->id, 'active'))}}">                        
                        <i class="fa fa-circle tip" aria-hidden="true" data-placement="top" data-original-title="{{trans('labels.active')}} ?"></i>
                    </a>
                </td>
                <td class="center">
                    <a href="javascript:void(0);" class="change-flag {{$homepage = $el->homepage ? 'colorGreen' : 'colorRed'}}" data-route="{{action('Lab\ReviewController@changeFlag', array($el->id, 'homepage'))}}">                        
                        <i class="fa fa-circle tip" aria-hidden="true" data-placement="top" data-original-title="{{trans('labels.homepage')}} ?"></i>
                    </a>
                </td>
                <td>{{$el->id}}</td>
                <td>{{$el->title}}</td>
                <td>{{$el->name}}</td>
                <td>{{$el->type}}</td>
                <td>{{$el->el->title}}</td>
                <td>{{date($default_lang->datetime, strtotime($el->created_at))}}</td>
                <td>{{date($default_lang->datetime, strtotime($el->updated_at))}}</td>
                <td class="right">
                    <div class="btn-group btn-group-xs">
                        <button href="javascript:void(0);" class="btn btn-primary get-html" data-route="{{action('Lab\ReviewController@edit', array($el->id))}}"><i class="fa fa-fw fa-pencil" aria-hidden="true"></i></button>
                        <button href="javascript:void(0);" class="btn btn-danger delete-json" data-route="{{action('Lab\ReviewController@destroy', array($el->id))}}" data-token="{{ csrf_token() }}" data-callback="$(btn).closest('tr').remove()" data-confirm="{{trans('labels.confirm-delete')}}"><i class="fa fa-fw fa-trash" aria-hidden="true"></i></button>
                    </div>                                
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- pagination -->
    @include('lab.review.pagination.default')

    @else

    <div class="alert alert-block">
        <h4>Ops!</h4>
        <p>{{trans('labels.no_element_found')}}</p>
    </div>

    @endif

@endsection