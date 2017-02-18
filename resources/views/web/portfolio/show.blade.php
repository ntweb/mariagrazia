@extends('web.index')

@section('content')

    @if($page->img)
    <img src="{{img($page,'img','600xn')}}" alt="">
    @endif
    <br><br>
    {{fdate($page->begin)}}
    <br><br>

    {{$page->title}}
    <br>
    {!! $page->description !!}

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

@endsection