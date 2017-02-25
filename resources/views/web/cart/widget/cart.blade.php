Carrello n. pezzi: {{Cart::instance('main')->count()}} <br>
Carrello tot: {{euro(Cart::instance('main')->total() + Cart::instance('codicesconto')->total())}} &euro; <br>

@if(Cart::instance('main')->count() > 0)
  <ul>    
  @foreach (Cart::instance('main')->content() as $rowId => $row)
    <li class="row-{{$rowId}}">
        @if (isset($row->options->product['thumb']))
          <img src="{{$row->options->product['thumb']}}" alt="">
        @else
          no-prev-img
        @endif      
        - 
        {{$row->name}} 
        - 
        {{euro($row->subtotal)}} 
        - 
        {{$row->qty}} pz./ {{@$row->options->product['size']}} / {{@$row->options->product['color']}} 
        - 
        <a href="javascript:void(0);" data-cart-widget="delete" data-v=".row-{{$rowId}}" data-route="{{action('Web\CartController@delete', array($rowId))}}">x</a>
    </li>
  @endforeach
  @foreach (Cart::instance('coupon')->content() as $rowId => $row)
  <li class="row-{{$rowId}}">           
      {{$row->name}} - {{euro($row->subtotal)}} &euro;
  </li>
  @endforeach  
  </ul>
@else
    <p class="alert alert-info">{{trans('labels.cart_empty')}}</p>
@endif

<a href="{{action('Web\CartController@checkout')}}" >{{trans('labels.checkout')}}</a>    