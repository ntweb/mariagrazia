<ul class="breadcrumbs">
    <li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
    <li>{{$mod_name}}</li>
</ul>

<div class="pageheader">
    <div class="pageicon"><span class="fa fa-pencil"></span></div>
    <div class="pagetitle">
        <h5>{{$mod_action}}</h5>
        <h1>{{$mod_object}}</h1>
    </div>
</div>

<div class="maincontent">
    <div class="maincontentinner">

        @yield('content')

    </div>
</div>