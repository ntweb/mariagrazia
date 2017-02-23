{{-- important --}}

@if(!isset($show_search))

<ol class="breadcrumb">
  	<li><a href="{{ action('Web\HomepageController@index') }}">Home</a></li>

  	@if (session()->has('breadcrumb_cat'))  	
  	<li><a href="{{ action('Web\CategoryController@index', array(session()->get('breadcrumb_cat')->murl, session()->get('breadcrumb_cat')->id)) }}">{{session()->get('breadcrumb_cat')->title}}</a></li>
  	@endif

  	@if (session()->has('breadcrumb_subcat'))  	
  	<li><a href="{{ action('Web\SubcategoryController@index', array(session()->get('breadcrumb_cat')->murl, session()->get('breadcrumb_subcat')->murl, session()->get('breadcrumb_subcat')->id)) }}">{{session()->get('breadcrumb_subcat')->title}}</a></li>
  	@endif

  	@if (session()->has('breadcrumb_prod'))  	
  	<li><a href="{{ action('Web\ProductController@show', array(session()->get('breadcrumb_cat')->murl, session()->get('breadcrumb_subcat')->murl, session()->get('breadcrumb_prod')->murl, session()->get('breadcrumb_prod')->id)) }}">{{session()->get('breadcrumb_prod')->title}}</a></li>
  	@endif
</ol>

@endif