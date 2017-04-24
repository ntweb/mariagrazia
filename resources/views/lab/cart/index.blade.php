@extends('lab.cart.default')

@section('content')

    <div class="headtitle">
        <div class="btn-group">
            <button data-toggle="dropdown" class="btn dropdown-toggle">{{request('type', trans('lab.all'))}} <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="javascript:void(0);" class="get-html" data-route="{{action('Lab\CartController@index')}}">{{trans('lab.all')}}</a></li>
                <li class="divider"></li>
                @foreach ($arrType as $t)
                <li><a href="javascript:void(0);" class="get-html" data-route="{{action('Lab\CartController@index')}}?type={{$t}}">{{$t}}</a></li>
                @endforeach
            </ul>
          </div>
        <h4 class="widgettitle title-primary">{{trans('lab.list')}}</h4>
    </div>

    @if(count($arrElements))

    <table class="table table-striped responsive">
        <thead>
            <tr>                
                <th>ID</th>
                <th>{{trans('lab.status')}}</th>                
                <th>{{trans('lab.label')}}</th>
                <th>{{trans('lab.user')}}</th>
                <th></th>
                <th class="right">{{trans('lab.amount')}}</th>
                <th></th>
                <th>{{trans('lab.payment')}}</th>
                <th>{{trans('lab.created_at')}}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($arrElements as $el)
            <tr>
                <td>{{$el->id}}</td>
                <td><span class="label {{$el->type}}">{{$el->type}}</span></td>
                <td>{{$el->label}}</td>
                <td>{{$el->user->name}} {{$el->user->lastname}}</td>
                <td><i class="fa fa-envelope-o" aria-hidden="true"></i> <i>{{$el->user->email}}</i></td>
                <td class="right"><b>{{ euro($el->total) }}</b></td>
                <td class="right">
                    <a href="javascript:void(0);" class=" {{$paid = $el->paid ? 'colorGreen' : 'colorRed'}}">
                        <i class="fa fa-circle tip" aria-hidden="true" data-placement="top" data-original-title="{{trans('lab.paid')}} ?"></i>
                    </a>
                </td>
                <td>
                    {{$el->payment->title}}
                </td>                
                <td>{{date($default_lang['datetime'], strtotime($el->created_at))}}</td>                
                <td class="right">
                    <div class="btn-group btn-group-xs">
                        <button href="javascript:void(0);" class="btn btn-primary get-html" data-route="{{action('Lab\CartController@edit', array($el->id))}}"><i class="fa fa-fw fa-pencil" aria-hidden="true"></i></button>
                    </div>                                
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- pagination -->
    @include('lab.cart.pagination.default')

    @else

    <div class="alert alert-block">
        <h4>Ops!</h4>
        <p>{{trans('lab.no_element_found')}}</p>
    </div>

    @endif

@endsection