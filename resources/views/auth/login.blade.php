@extends('web.index')

@section('content')

<h2>Login</h2>

<form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

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
            <input id="password" type="password" class="form-control" name="password" required>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>

    {{--
    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
    --}}

    <button type="submit" class="btn btn-primary">
        Login
    </button>

    <a class="btn btn-link" href="{{ route('password.request') }}">
        Forgot Your Password?
    </a>
    
</form>

<hr>

Or Login with Facebook -> <a href="{{action('Web\FacebookController@redirectToProvider')}}">Facebook Login</a>
           
@endsection