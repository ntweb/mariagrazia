@extends('lab.coupon.default')

@section('content')

    <div class="headtitle">
        <h4 class="widgettitle title-primary">{{trans('lab.list')}}</h4>
    </div>

    @if(count($arrElements))

    <table class="table table-striped responsive">
        <thead>
            <tr>
                <th class="center"><i class="fa fa-power-off" aria-hidden="true"></i></th>                
                <th class="center"><i class="fa fa-shield" aria-hidden="true"></i></th>                
                <th>USER ID</th>
                <th>BUSINESS ID</th>
                <th>{{trans('lab.businessname')}}</th>
                <th>{{trans('lab.email')}}</th>
                <th>{{trans('lab.telephone')}}</th>
                <th>{{trans('lab.created_at')}}</th>
                <th>{{trans('lab.updated_at')}}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($arrElements as $el)
            <?php $business = $el->b; ?>
            <tr>
                <td class="center">
                    <a href="javascript:void(0);" class="change-flag {{$active = $el->active ? 'colorGreen' : 'colorRed'}}" data-route="{{action('Lab\BusinessController@changeFlag', array($el->id, 'active'))}}">
                        <i class="fa fa-circle tip" aria-hidden="true" data-placement="top" data-original-title="{{trans('lab.active')}} ?"></i>
                    </a>
                </td>
                <td class="center">
                    <a href="javascript:void(0);" class="cannot-change-flag {{$verified = $el->verified ? 'colorGreen' : 'colorRed'}}" data-route="{{action('Lab\BusinessController@changeFlag', array($el->id, 'verified'))}}">
                        <i class="fa fa-circle tip" aria-hidden="true" data-placement="top" data-original-title="{{trans('lab.verified')}} ?"></i>
                    </a>
                </td>
                <td>{{$el->id}}</td>
                <td>{{$business->id}}</td>
                <td>{{$business->businessname}}</td>
                <td>{{$el->email}}</td>                
                <td>{{$business->telephone}}</td>                
                <td>{{date($default_lang['datetime'], strtotime($el->created_at))}}</td>
                <td>{{date($default_lang['datetime'], strtotime($el->updated_at))}}</td>
                <td class="right">
                    <div class="btn-group btn-group-xs">
                        <button href="javascript:void(0);" class="btn btn-primary get-html" data-route="{{action('Lab\BusinessController@edit', array($el->id))}}"><i class="fa fa-fw fa-pencil" aria-hidden="true"></i></button>
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
        <p>{{trans('lab.no_element_found')}}</p>
    </div>

    @endif

@endsection