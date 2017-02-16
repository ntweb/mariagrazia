<div class="row">
    <div class="col-md-6">
        
        {{-- list of options --}}
        <table class="table responsive">
            <thead>
                <tr>
                    @if(request('type') || count($arrType) == 1)
                    <th></th>
                    @endif
                    <th class="center"><i class="fa fa-power-off" aria-hidden="true"></i></th>
                    <th>ID</th>
                    <th>{{trans('labels.type')}}</th>
                    <th>{{trans('labels.title')}}</th>
                    <th></th>
                    <th class="right">{{trans('labels.price')}}</th>
                    <th class="right">

                        <div class="btn-group btn-group-xs">
                            <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">{{request('type', trans('labels.all'))}} <span class="caret"></span></button>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);" class="get-html" data-route="{{action('Lab\ProductoptionController@index')}}?id_product={{request()->get('id_product')}}" data-container="#tabs-productoptions">{{trans('labels.all')}}</a></li>
                                <li class="divider"></li>
                                @foreach ($arrType as $t)
                                <li><a href="javascript:void(0);" class="get-html" data-route="{{action('Lab\ProductoptionController@index')}}?id_product={{request()->get('id_product')}}&type={{$t}}" data-container="#tabs-productoptions">{{$t}}</a></li>
                                @endforeach
                            </ul>
                        </div>                     

                    </th>                    
                </tr>
            </thead>
            <tbody class="sortable" data-route="{{action('Lab\OrderController@update', array($table))}}" data-token="{{ csrf_token() }}">
                @if (count($arrElements))
                @foreach ($arrElements as $el)
                <tr id="item-{{$el->id}}">
                    @if(request('type') || count($arrType) == 1)
                        <td class="handle"><i class="fa fa-sort" aria-hidden="true"></i></td>
                    @endif 
                    <td class="center">
                        <a href="javascript:void(0);" class="change-flag {{$active = $el->active ? 'colorGreen' : 'colorRed'}}" data-route="{{action('Lab\ProductoptionController@changeFlag', array($el->id, 'active'))}}">                        
                            <i class="fa fa-circle tip" aria-hidden="true" data-placement="top" data-original-title="{{trans('labels.active')}} ?"></i>
                        </a>
                    </td>                                                       
                    <td>{{$el->id}}</td>
                    <td>{{$el->type}}</td>
                    <td>{{$el->title}}</td>                    
                    <td class="center">
                        @if($el->type == 'color')
                        <i class="fa fa-square" aria-hidden="true" style="color: {{$el->color}};"></i>
                        @endif
                    </td>                    
                    <td class="right">{{$el->price}} <i class="fa fa-euro" aria-hidden="true"></i></td>                    
                    <td class="right">
                    <div class="btn-group btn-group-xs">
                        <button href="javascript:void(0);" class="btn btn-primary get-html" data-route="{{action('Lab\ProductoptionController@edit', array($el->id))}}" data-container="#modify-form-option" data-callback="$('#create-form-option').html('');$('#create-option').hide(0)"><i class="fa fa-fw fa-pencil" aria-hidden="true"></i></button>
                        <button href="javascript:void(0);" class="btn btn-danger delete-json" data-route="{{action('Lab\ProductoptionController@destroy', array($el->id))}}" data-token="{{ csrf_token() }}" data-callback="$(btn).closest('tr').remove()" data-confirm="{{trans('labels.confirm-delete')}}"><i class="fa fa-fw fa-trash" aria-hidden="true"></i></button>
                    </div>                           
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="7">
                        <div class="alert alert-block">
                            <h4>Ops!</h4>
                            <p>{{trans('labels.no_element_found')}}</p>
                        </div>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>

    </div>
    <div class="col-md-6">
        
        {{-- form di update --}}
        <div id="modify-form-option"></div>

        {{-- form di creazione --}}
        <div id="create-form-option"></div>

        <div id="create-option" class="center">
            <br><br>
            <button class="btn btn-primary get-html" data-route="{{$route}}" data-container="#create-form-option" data-callback="$('#create-option').hide(0)">{{trans('labels.new_option')}}</button>
        </div>

    </div>
</div>