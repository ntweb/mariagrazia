@extends('lab.parameter.default')

@section('content')

    <div class="tabbedwidget tab-primary">
        <ul>
            <li><a href="#tabs-settings"><i class="fa fa-wrench" aria-hidden="true"></i> {{trans('labels.settings')}}</a></li>
        </ul>

        <div id="tabs-settings">
            
			<form class="stdform stdform2 ns" data-route="{{action('Lab\ParameterController@update')}}" data-method='PUT'>
			{!! csrf_field() !!}    {{-- token --}}

		        @foreach ($arrParameters as $el)

		        <p>
		            <label>{{$el->label}}</label>
		            <span class="field">
		        		@if ($el->value || !$el->extras)
		                	<input type="text" name="value__{{$el->label}}" class="form-control" value="{{$el->value}}" />
	                	@else
	                		<textarea name="extras__{{$el->label}}" class="wysiwyg_editor">{{$el->extras}}</textarea>
	                	@endif
		            </span>
		        </p>
			                                    
		        @endforeach

			    <p class="stdformbutton">
			        <button type="submit" class="btn btn-primary">{{trans('labels.save')}}</button>
			    </p>
			</form>

        </div>
    </div>

@endsection