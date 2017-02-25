<a href="javascript:void(0);" data-cart-widget="mod_qty" data-target="{{$page->id}}" data-v="-1">-</a>
<input class="target-{{$page->id}}" readonly="readonly" type="text" value="1" />
<a href="javascript:void(0);" data-cart-widget="mod_qty" data-target="{{$page->id}}" data-v="1">+</a>

<button data-cart-widget="add" data-target=".cart-form-{{$page->id}}">ADD</button>

{{-- Form Cart --}}
<form class="cart-form-{{$page->id}}" data-route="{{action('Web\CartController@add')}}" style="display: block;">
{!! csrf_field() !!}    {{-- token --}}

	<input type="text" name="id" value="{{$page->id}}">
	<input type="text" name="qty" value="1">

	{{-- disable if doesn't exist --}}
	@if ($options_colors->count())
	<input type="text" name="color" value="{{$options_colors->first()->title}}">
	@endif
	@if ($options_sizes->count())
	<input type="text" name="size" value="{{$options_sizes->first()->title}}">
	@endif

</form>
{{-- fine Form Cart --}}  