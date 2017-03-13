@extends('lab.coupon.default')

@section('content')

    <div class="headtitle">
        <div class="btn-group">
            <button data-toggle="dropdown" class="btn dropdown-toggle">{{request('type', trans('labels.all'))}} <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="javascript:void(0);" class="get-html" data-route="{{action('Lab\CouponController@index')}}">{{trans('labels.all')}}</a></li>
                <li class="divider"></li>
                @foreach ($arrType as $t)
                <li><a href="javascript:void(0);" class="get-html" data-route="{{action('Lab\CouponController@index')}}?type={{$t}}">{{$t}}</a></li>
                @endforeach
            </ul>
          </div>
        <h4 class="widgettitle title-primary">{{trans('labels.list')}}</h4>
    </div>

    @if(count($arrElements))

    <table class="table table-striped responsive">
        <thead>
            <tr>
            @if(request('type') || count($arrType) == 1)
                <th></th>
            @endif
                <th class="center"><i class="fa fa-power-off" aria-hidden="true"></i></th>                
                <th class="center"><i class="fa fa-users" aria-hidden="true"></i></th>                
                <th>ID</th>
                <th>{{trans('labels.title')}}</th>
                <th>{{trans('labels.code')}}</th>
                <th>{{trans('labels.type')}}</th>
                <th class="right">{{trans('labels.amount')}}</th>
                <th>{{trans('labels.begin')}}</th>
                <th>{{trans('labels.end')}}</th>
                <th>{{trans('labels.created_by')}}</th>
                <th>{{trans('labels.created_at')}}</th>
                <th>{{trans('labels.updated_at')}}</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="sortable" data-route="{{action('Lab\OrderController@update', array($table))}}" data-token="{{ csrf_token() }}">
            @foreach ($arrElements as $el)
            <tr id="item-{{$el->id}}">
            @if(request('type') || count($arrType) == 1)
                <td class="handle"><i class="fa fa-sort" aria-hidden="true"></i></td>
            @endif
                <td class="center">
                    <a href="javascript:void(0);" class="change-flag {{$active = $el->active ? 'colorGreen' : 'colorRed'}}" data-route="{{action('Lab\CouponController@changeFlag', array($el->id, 'active'))}}">                        
                        <i class="fa fa-circle tip" aria-hidden="true" data-placement="top" data-original-title="{{trans('labels.active')}} ?"></i>
                    </a>
                </td>
                <td class="center">
                    <a href="javascript:void(0);" class="change-flag {{$multipleusers = $el->multipleusers ? 'colorGreen' : 'colorRed'}}" data-route="{{action('Lab\CouponController@changeFlag', array($el->id, 'multipleusers'))}}">                        
                        <i class="fa fa-circle tip" aria-hidden="true" data-placement="top" data-original-title="{{trans('labels.multipleusers')}} ?"></i>
                    </a>
                </td>
                <td>{{$el->id}}</td>
                <td>{{$el->title}}</td>
                <td>{{$el->code}}</td>
                <td>{{$el->type}}</td>
                <td class="right">{{$el->amount}}</td>
                <td>@if($el->begin) {{date($default_lang['date'], strtotime($el->begin))}} @endif</td>
                <td>@if($el->end) {{date($default_lang['date'], strtotime($el->end))}} @endif</td>
                <td>{{$el->created_by->name}}</td>
                <td>{{date($default_lang['datetime'], strtotime($el->created_at))}}</td>
                <td>{{date($default_lang['datetime'], strtotime($el->updated_at))}}</td>
                <td class="right">
                    <div class="btn-group btn-group-xs">
                        <button href="javascript:void(0);" class="btn btn-primary get-html" data-route="{{action('Lab\CouponController@edit', array($el->id))}}"><i class="fa fa-fw fa-pencil" aria-hidden="true"></i></button>
                        <button href="javascript:void(0);" class="btn btn-danger delete-json" data-route="{{action('Lab\CouponController@destroy', array($el->id))}}" data-token="{{ csrf_token() }}" data-callback="$(btn).closest('tr').remove()" data-confirm="{{trans('labels.confirm-delete')}}"><i class="fa fa-fw fa-trash" aria-hidden="true"></i></button>
                    </div>                                
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- pagination -->
    @include('lab.coupon.pagination.default')

    @else

    <div class="alert alert-block">
        <h4>Ops!</h4>
        <p>{{trans('labels.no_element_found')}}</p>
    </div>

    @endif

@endsection