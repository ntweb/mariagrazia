<p id="review_stored" class="alert alert-success" style="display: none;">
	{{trans('labels.review_stored')}}
</p>

<form class="ns_review ns" action="#" data-route="{{action('Web\ReviewController@store')}}" data-callback="$('#review_stored').show(0);$('.ns_review').hide(0)" >
{!! csrf_field() !!}    {{-- token --}}
<input type="hidden" name="id_el" value="{{$page->id}}">
<input type="hidden" name="type" value="{{$review_type}}">

<input type="radio" name="vote" value="1"> 1
<input type="radio" name="vote" value="2"> 2
<input type="radio" name="vote" value="3"> 3
<input type="radio" name="vote" value="4"> 4
<input type="radio" name="vote" value="5" checked="checked"> 5
<br>
<input type="text" name="title" placeholder="{{trans('labels.subject')}}" /><br>
<input type="text" name="name" placeholder="{{trans('labels.name')}}" /><br>
<input type="text" name="email" placeholder="{{trans('labels.email')}}" /><br>
{{trans('labels.no_email_show')}} <br>
<input type="text" name="site" placeholder="{{trans('labels.site')}}" /><br>
<textarea name="description" cols="30" rows="5" placeholder="{{trans('labels.description')}}"></textarea><br>
<button type="submit">{{trans('labels.send')}}</button>
</form>