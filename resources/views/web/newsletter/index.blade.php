<form class="ns" data-route="{{action('Web\NewsletterController@store')}}" data-callback="$('input[name=email]').val('')">
{{ csrf_field() }}

	<input type="text" name="email" placeholder="email">
	<button type="submit">Iscriviti</button>

</form>