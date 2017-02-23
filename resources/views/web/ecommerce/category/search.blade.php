<form action="{{action('Web\ProductController@index')}}" method="GET">

	<input type="text" name="key" placeholder="search..." value="{{ old('key') }}">
	<button type="submit"> search </button>

</form>