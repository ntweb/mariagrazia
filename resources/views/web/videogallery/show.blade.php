@extends('web.index')

@section('content')


    <div class="container">
        <div class="row ">
            <div class="col-md-4">
                
                <div class="embed-responsive embed-responsive-16by9">
                {!! youtube_video($page->url) !!}
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="row ">
            <div class="col-md-8">
                
                <div class="embed-responsive embed-responsive-16by9">
                {!! youtube_video($page->url) !!}
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                
                <div class="embed-responsive embed-responsive-16by9">
                {!! youtube_video($page->url) !!}
                </div>

            </div>
        </div>
    </div>

    <br><br>
    {{fdate($page->begin)}}
    <br><br>

    {{$page->title}}
    <br>
    {!! $page->description !!}

@endsection