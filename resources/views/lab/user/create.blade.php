@extends('lab.page.default')

@section('content')

    <div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 profile-left">
    
        <form class="ns" data-route="{{$route}}" data-callback="getHtml(param)" >
        {!! csrf_field() !!}

            <div class="widgetbox login-information">
                <h4 class="widgettitle">Login Information</h4>
                <div class="widgetcontent form-horizontal">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Name</label>
                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Email</label>
                        <div class="col-md-10">
                            <input type="text" name="email" class="form-control" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Password</label>
                        <div class="col-md-10">
                            <input type="text" name="password" class="form-control" value="" />
                        </div>
                    </div>                                                        
                </div>
            </div>   
            <p>
                <button type="submit" class="btn btn-primary">{{trans('lab.save')}}</button>
            </p>
        </form>

    </div>
    
@endsection