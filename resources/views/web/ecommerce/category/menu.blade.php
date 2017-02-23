<h2>Catalogo</h2>
<ul>	

{{-- important --}}
<?php $cat_id = (session()->has('breadcrumb_cat')) ? session()->get('breadcrumb_cat')->id : null; ?>
<?php $subcat_id = (session()->has('breadcrumb_subcat')) ? session()->get('breadcrumb_subcat')->id : null; ?>
{{-- important --}}

@foreach ($arrCategories as $cat)
	<li>
		<?php $cat_murl = $cat->murl; ?>
		<a href="{{action('Web\CategoryController@index', array($cat_murl, $cat->id))}}" @if($cat_id == $cat->id) style="font-weight: bold;" @endif>
			{{$cat->title}}
		</a>
		
		<ul>					
		@foreach ($cat->subcategories()->get() as $subcat)
			<li>
				<a href="{{action('Web\SubcategoryController@index', array($cat_murl, $subcat->murl, $subcat->id))}}" @if($subcat_id == $subcat->id) style="font-weight: bold;" @endif>
					{{$subcat->title}} ({{$subcat->products()->count()}})
				</a>
			</li>
		@endforeach
		</ul>
	</li>
@endforeach
</ul>