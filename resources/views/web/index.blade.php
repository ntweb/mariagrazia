<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    {{-- FontAwesome Preferred distr --}}
    <link href="{{url('css/font-awesome.min.css')}}" rel="stylesheet">

  </head>
  <body>

    <ul>
      <li><a href="{{action('Web\HomepageController@index')}}">Home</a></li>
      <li><a href="{{action('Web\NewsController@index')}}">News</a></li>
      <li><a href="{{action('Web\BlogController@index')}}">Blog</a></li>
      <li><a href="{{action('Web\PageController@show', array(1, 'titolo-della-pagina'))}}">Pagina</a></li>
      <li><a href="{{action('Web\ServiceController@index')}}">Servizi</a></li>
      <li><a href="{{action('Web\StaffController@show', array(1, 'titolo-della-persona'))}}">Staff</a></li>
      <li><a href="{{action('Web\PhotogalleryController@index')}}">Photogallery</a></li>
      <li><a href="{{action('Web\VideogalleryController@index')}}">Videogallery</a></li>
      <li><a href="{{action('Web\PortfolioController@index')}}">Portfolio</a></li>

      @if (!isset($route_loalization_resource))
        <li><a href="{{ LaravelLocalization::getLocalizedURL('it') }}">Italiano no risorsa</a></li>
        <li><a href="{{ LaravelLocalization::getLocalizedURL('en') }}">English no risorsa</a></li>
      @else
        <li><a href="{{ LaravelLocalization::getURLFromRouteNameTranslated('it', $route_loalization_resource, $route_loalization_resource_param['it']) }}">Italiano Risorsa</a></li>
        <li><a href="{{ LaravelLocalization::getURLFromRouteNameTranslated('en', $route_loalization_resource, $route_loalization_resource_param['en']) }}">English Risorsa</a></li>
      @endif
    </ul>
    
    @yield('content')

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{url('js/jquery-1.12.4.js')}}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{url('js/bootstrap.min.js')}}"></script>

    {{-- my library --}}
    <script src="{{url('js/_site_library.js')}}"></script>

  </body>
</html>