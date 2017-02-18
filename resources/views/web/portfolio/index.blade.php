@extends('web.index')

@section('content')

    {{$page->title}}
    <br>
    {{$page->description}}

    <h2>Portfolio</h2>

    <h2>Types</h2>
    <ul>
        @foreach ($arrTypes as $type)
            <li>{{$type}}</li>
        @endforeach
    </ul>

    <div class="container">
        <div class="row">
            @foreach ($arrElements as $el)
            <div class="col-md-3">                
                {{$el->title}} <br>
                {{$el->abstract}} <br>
                {{fdate($el->begin)}} <br>
                
                @if ($el->img)
                <img src="{{img($el,'img','Nx300')}}" class="img-responsive" alt="">
                @endif

                <br><br>
                <a href="{{action('Web\PortfolioController@show', array($el->id, $el->murl))}}">Leggi</a>

            </div>
            @endforeach
        </div>
    </div>

    <!-- pagination -->
    @include('web.pagination.default')    

@endsection