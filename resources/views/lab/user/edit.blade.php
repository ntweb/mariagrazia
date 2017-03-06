@extends('lab.page.default')

@section('content')

    <div class="col-md-5 profile-left">
    
        <form class="ns" data-method='PUT' data-route="{{action('Lab\UserController@password', array($el->id))}}" >
        {!! csrf_field() !!}

            <div class="widgetbox login-information">
                <h4 class="widgettitle">Login Information</h4>
                <div class="widgetcontent form-horizontal">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Email</label>
                        <div class="col-md-10">
                            <input type="text" name="email" class="form-control" value="{{$el->email}}" disabled="disabled" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Password</label>
                        <div class="col-md-10">
                            <input type="text" name="password" class="form-control" value="" placeholder="{{trans('labels.new-password')}}" />
                        </div>
                    </div>                                                        
                </div>
            </div>   
            <p>
                <button type="submit" class="btn btn-primary">{{trans('labels.save')}}</button>
            </p>
        </form>

    @if(Auth::user()->administrator)
        <hr>

        <form class="ns" data-method='PUT' data-route="{{action('Lab\UserController@update', array($el->id))}}" >
        {!! csrf_field() !!}

            <div class="widgetbox login-information">
                <h4 class="widgettitle">Account type</h4>
                <div class="widgetcontent form-horizontal">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Admin</label>
                        <div class="col-md-10">
                            <select name="administrator" class="form-control">
                                <option value="0" @if(!$el->administrator) selected="selected" @endif>{{trans('labels.no')}}</option>
                                <option value="1" @if($el->administrator) selected="selected" @endif>{{trans('labels.yes')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Editor</label>
                        <div class="col-md-10">
                            <select name="wysiwyg_editor" class="form-control">
                                <option value="0" @if(!$el->editor) selected="selected" @endif>{{trans('labels.no')}}</option>
                                <option value="1" @if($el->editor) selected="selected" @endif>{{trans('labels.yes')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Limited</label>
                        <div class="col-md-10">
                            <select name="limited" class="form-control">
                                <option value="0" @if(!$el->limited) selected="selected" @endif>{{trans('labels.no')}}</option>
                                <option value="1" @if($el->limited) selected="selected" @endif>{{trans('labels.yes')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Active</label>
                        <div class="col-md-10">
                            <select name="active" class="form-control">
                                <option value="0" @if(!$el->active) selected="selected" @endif>{{trans('labels.no')}}</option>
                                <option value="1" @if($el->active) selected="selected" @endif>{{trans('labels.yes')}}</option>
                            </select>
                        </div>
                    </div>                                                                                                      
                </div>
            </div>   
            <p>
                <button type="submit" class="btn btn-primary">{{trans('labels.save')}}</button>
            </p>
        </form>
    @endif

    </div>

    <div class="col-md-7">
                
        <form class="ns" data-method='PUT' data-route="{{action('Lab\UserController@update', array($el->id))}}" >
        {!! csrf_field() !!}

            <div class="widgetbox personal-information">
                <h4 class="widgettitle">Personal Information</h4>
                <div class="widgetcontent form-horizontal">
                                
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{trans('labels.name')}}</label>
                        <div class="col-md-10">
                           <input type="text" name="name" class="form-control" value="{{$el->name}}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">{{trans('labels.lastname')}}</label>
                        <div class="col-md-10">
                           <input type="text" name="lastname" class="form-control" value="{{$el->lastname}}" />
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <p>
               <button type="submit" class="btn btn-primary">{{trans('labels.save')}}</button>
            </p>
            
        </form>
    </div>
    
@endsection