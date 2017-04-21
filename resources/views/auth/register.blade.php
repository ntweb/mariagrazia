@extends('web.index')

@section('content')

    <div class="panel-heading">Register</div>
    <div class="panel-body">
        <form class="form-horizontal ns-disable-submit" role="form" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">{{trans('labels.name')}}</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">{{trans('labels.lastname')}}</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" autofocus>

                    @if ($errors->has('lastname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('lastname') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('businessname') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">{{trans('labels.businessname')}}</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="businessname" value="{{ old('businessname') }}" autofocus>

                    @if ($errors->has('businessname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('businessname') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('cf') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">{{trans('labels.cf')}}</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="cf" value="{{ old('cf') }}" autofocus>

                    @if ($errors->has('cf'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cf') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('vat') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">{{trans('labels.vat')}}</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="vat" value="{{ old('vat') }}" autofocus>

                    @if ($errors->has('vat'))
                        <span class="help-block">
                            <strong>{{ $errors->first('vat') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">{{trans('labels.telephone')}}</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="telephone" value="{{ old('telephone') }}" autofocus>

                    @if ($errors->has('telephone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('telephone') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">{{trans('labels.city')}}</label>

                <div class="col-md-6">
                    <input type="hidden" name="political_short_name" value="{{ old('political_short_name') }}">
                    <input type="hidden" name="country_short_name" value="{{ old('country_short_name') }}">
                    <input type="hidden" name="place_id" value="{{ old('place_id') }}">

                    <input type="text" class="form-control" name="city" value="{{ old('city') }}" autofocus>

                    @if ($errors->has('city'))
                        <span class="help-block">
                            <strong>{{ $errors->first('city') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">{{trans('labels.address')}}</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="address" value="{{ old('address') }}" autofocus>

                    @if ($errors->has('address'))
                        <span class="help-block">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('street_number') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">{{trans('labels.street_number')}}</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="street_number" value="{{ old('street_number') }}" autofocus>

                    @if ($errors->has('street_number'))
                        <span class="help-block">
                            <strong>{{ $errors->first('street_number') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('postal_code') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">{{trans('labels.postal_code')}}</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="postal_code" value="{{ old('postal_code') }}" autofocus>

                    @if ($errors->has('postal_code'))
                        <span class="help-block">
                            <strong>{{ $errors->first('postal_code') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" >

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" >

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" id="btnRegister" class="btn btn-primary">
                        Register
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection
