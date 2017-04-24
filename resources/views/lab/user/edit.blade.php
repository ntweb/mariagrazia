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
                            <input type="text" name="password" class="form-control" value="" placeholder="{{trans('lab.new-password')}}" />
                        </div>
                    </div>                                                        
                </div>
            </div>   
            <p>
                <button type="submit" class="btn btn-primary">{{trans('lab.save')}}</button>
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
                                <option value="0" @if(!$el->administrator) selected="selected" @endif>{{trans('lab.no')}}</option>
                                <option value="1" @if($el->administrator) selected="selected" @endif>{{trans('lab.yes')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Editor</label>
                        <div class="col-md-10">
                            <select name="editor" class="form-control">
                                <option value="0" @if(!$el->editor) selected="selected" @endif>{{trans('lab.no')}}</option>
                                <option value="1" @if($el->editor) selected="selected" @endif>{{trans('lab.yes')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Limited</label>
                        <div class="col-md-10">
                            <select name="limited" class="form-control">
                                <option value="0" @if(!$el->limited) selected="selected" @endif>{{trans('lab.no')}}</option>
                                <option value="1" @if($el->limited) selected="selected" @endif>{{trans('lab.yes')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Active</label>
                        <div class="col-md-10">
                            <select name="active" class="form-control">
                                <option value="0" @if(!$el->active) selected="selected" @endif>{{trans('lab.no')}}</option>
                                <option value="1" @if($el->active) selected="selected" @endif>{{trans('lab.yes')}}</option>
                            </select>
                        </div>
                    </div>                                                                                                      
                </div>
            </div>   
            <p>
                <button type="submit" class="btn btn-primary">{{trans('lab.save')}}</button>
            </p>
        </form>
    @endif

    </div>

    <div class="col-md-7">
                
        <form class="clearfix ns" data-route="{{action('Lab\UserController@setAvatar')}}" data-callback="changeAvatarPic('param')">
        {!! csrf_field() !!}

            <div class="widgetbox personal-information">
                <h4 class="widgettitle">Avatar</h4>
                <div class="widgetcontent form-horizontal">

                    <div class="form-group">
                        <div class="col-md-8">
                            <div id="crop-img"></div>          
                        </div> 
                        <div class="col-md-4">
                            <br>
                            <br>
                            <input type="file" id="upload" class="filestyle" accept="image/*">
                            <br>
                            <button class="btn btn-primary upload-crop" style="display: none;"><i class="fa fa-floppy-o" aria-hidden="true"></i> {{trans('lab.save')}}</button>
                        </div>  
                        <div class="col-md-8 col-md-offset-2 text-center">
                        </div>

                    </div>

                    <textarea name="base64Pic" id="base64Pic" style="display: none;"></textarea>

                </div>
            </div>        

        </form>

        <form class="ns" data-method='PUT' data-route="{{action('Lab\UserController@update', array($el->id))}}" >
        {!! csrf_field() !!}

            <div class="widgetbox personal-information">
                <h4 class="widgettitle">Personal Information</h4>
                <div class="widgetcontent form-horizontal">
                                
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{trans('lab.name')}}</label>
                        <div class="col-md-10">
                           <input type="text" name="name" class="form-control" value="{{$el->name}}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">{{trans('lab.lastname')}}</label>
                        <div class="col-md-10">
                           <input type="text" name="lastname" class="form-control" value="{{$el->lastname}}" />
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