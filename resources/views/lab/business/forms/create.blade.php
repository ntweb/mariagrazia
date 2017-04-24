<form class="stdform stdform2 ns" 
    data-route="{{$route}}" 
        @if(isset($el)) 
            data-method='PUT' 
        @else 
            data-callback="getHtml(param)" 
        @endif
>

{!! csrf_field() !!}    {{-- token --}}

    @if(!isset($el))
        
        {{-- creation --}}
        {{-- eventuale form di creazione --}}

    @else

        {{-- editing --}}
        <?php $business = $el->b; ?>
        <p>
            <label>{{trans('lab.name')}}</label>
            <span class="field">
                {{$el->name}} {{$el->lastname}}
            </span>
        </p>
        <p>
            <label>{{trans('lab.email')}}</label>
            <span class="field">
                {{$el->email}}
            </span>
        </p>
        <p>
            <label>{{trans('lab.businessname')}}</label>
            <span class="field">
                <input type="text" name="businessname" class="form-control" value="{{@$business->businessname}}" />
            </span>
        </p>
        <p>
            <label>{{trans('lab.cf')}}</label>
            <span class="field">
                <input type="text" name="cf" class="form-control" value="{{@$business->cf}}" />
            </span>
        </p>
        <p>
            <label>{{trans('lab.vat')}}</label>
            <span class="field">
                <input type="text" name="vat" class="form-control" value="{{@$business->vat}}" />
            </span>
        </p>
        <p>
            <label>{{trans('lab.telephone')}}</label>
            <span class="field">
                <input type="text" name="telephone" class="form-control" value="{{@$business->telephone}}" />
            </span>
        </p>

        <p>
            <label>{{trans('lab.political_short_name')}}</label>
            <span class="field">
                <input type="text" name="political_short_name" class="form-control" value="{{@$business->political_short_name}}" />
            </span>
        </p>

        <p>
            <label>{{trans('lab.country_short_name')}}</label>
            <span class="field">
                <input type="text" name="country_short_name" class="form-control" value="{{@$business->country_short_name}}" max="5" />
            </span>
        </p>
        <p>
            <label>{{trans('lab.city')}}</label>
            <span class="field">
                <input type="text" name="city" class="form-control" value="{{@$business->city}}" />
            </span>
        </p>
        <p>
            <label>{{trans('lab.address')}}</label>
            <span class="field">
                <input type="text" name="address" class="form-control" value="{{@$business->address}}" />
            </span>
        </p>
        <p>
            <label>{{trans('lab.street_number')}}</label>
            <span class="field">
                <input type="text" name="street_number" class="form-control" value="{{@$business->street_number}}" />
            </span>
        </p>
        <p>
            <label>{{trans('lab.postal_code')}}</label>
            <span class="field">
                <input type="text" name="postal_code" class="form-control" value="{{@$business->postal_code}}" />
            </span>
        </p>

    @endif
                                    
    <p class="stdformbutton">
        <button type="submit" class="btn btn-primary">{{trans('lab.save')}}</button>
    </p>
</form>