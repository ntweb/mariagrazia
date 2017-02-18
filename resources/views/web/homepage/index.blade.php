@extends('web.index')

@section('content')

    {{$page->title}}
    <br>
    {{$page->description}}

    <h2>News</h2>

    <div class="container">
        <div class="row">
            @foreach ($arrN as $el)
            <div class="col-md-3">                
                {{$el->title}} <br>
                {{$el->abstract}} <br>
                {{fdate($el->begin)}} <br>
                
                @if ($el->img)
                <img src="{{img($el,'img','Nx300')}}" class="img-responsive" alt="">
                @endif

                <br><br>
                <a href="{{action('Web\NewsController@show', array($el->id, $el->murl))}}">Leggi</a>

            </div>
            @endforeach
        </div>
    </div>

@endsection