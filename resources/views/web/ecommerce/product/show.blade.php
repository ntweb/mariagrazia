@if($page->img)
<img src="{{img($page,'img','600xn')}}" alt="">
@endif
<br><br>

{{$page->title}}
<br>
{!! $page->description !!}
<hr>
codice: {{$page->code}} <br>
price: {{ euro($page->price) }} <br>
price_discount: {{ euro($page->price_discount) }} <br>
is_new: {{$page->new}} <br>
is_discount: {{$page->discount}} <br>

Colors: 
@foreach ($options_colors as $el)
    <i class="fa fa-circle" aria-hidden="true" style="font-size: 28px; color: {{$el->color}};"></i> {{$el->title}}
@endforeach
<br><br>
Sizes:
<ul>
@foreach ($options_sizes as $el)
    <li><a href="#">{{$el->title}}</a></li>
@endforeach
</ul>

<hr>
<br><br>
<h2>Galleria immagini</h2>
@if(count($page_images))
<ul>        
@foreach ($page_images as $el)
    <li>            
        <img src="{{img($el, 'filename', '100x100')}}" alt=""> {{$el->mtitle}} | {{$el->mdescription}}
    </li>
@endforeach
@endif
</ul>

<hr>
<h2>Reviews</h2>
@foreach ($page_reviews as $el)
    <h4>{{$el->title}}</h4>
    {!! $el->description !!}
    @if ($el->answer)
    <div class="well">
        {!! $el->answer !!}
    </div>
    @endif
@endforeach

<br><br>

@include('web.review.index')