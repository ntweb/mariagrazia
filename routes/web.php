<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// CMS Route
$cms_folder = '_lab/';

// Login
Route::get($cms_folder, 'Lab\LoginController@login');
Route::get($cms_folder.'logout', 'Lab\LoginController@logout');
Route::post($cms_folder, 'Lab\LoginController@authenticate');

// Dashbosrd
Route::get($cms_folder.'dashboard', 'Lab\DashboardController@index');

// Page
Route::resource($cms_folder.'page', 'Lab\PageController');
Route::get($cms_folder.'page/delete/img/{id}/{img}', 'Lab\PageController@deleteImg');
Route::get($cms_folder.'page/change/flag/{id}/{field}', 'Lab\PageController@changeFlag');
Route::put($cms_folder.'page/settings/{id}', 'Lab\PageController@settings');

// News
Route::resource($cms_folder.'news', 'Lab\NewsController');
Route::get($cms_folder.'news/delete/img/{id}/{img}', 'Lab\NewsController@deleteImg');
Route::get($cms_folder.'news/change/flag/{id}/{field}', 'Lab\NewsController@changeFlag');
Route::put($cms_folder.'news/settings/{id}', 'Lab\NewsController@settings');

// Servizi
Route::resource($cms_folder.'service', 'Lab\ServiceController');
Route::get($cms_folder.'service/delete/img/{id}/{img}', 'Lab\ServiceController@deleteImg');
Route::get($cms_folder.'service/change/flag/{id}/{field}', 'Lab\ServiceController@changeFlag');
Route::put($cms_folder.'service/settings/{id}', 'Lab\ServiceController@settings');

// Staff
Route::resource($cms_folder.'staff', 'Lab\StaffController');
Route::get($cms_folder.'staff/delete/img/{id}/{img}', 'Lab\StaffController@deleteImg');
Route::get($cms_folder.'staff/change/flag/{id}/{field}', 'Lab\StaffController@changeFlag');
Route::put($cms_folder.'staff/registry/{id}', 'Lab\StaffController@registry');
Route::put($cms_folder.'staff/settings/{id}', 'Lab\StaffController@settings');

// Partners
Route::resource($cms_folder.'partner', 'Lab\PartnerController');
Route::get($cms_folder.'partner/delete/img/{id}/{img}', 'Lab\PartnerController@deleteImg');
Route::get($cms_folder.'partner/change/flag/{id}/{field}', 'Lab\PartnerController@changeFlag');
Route::put($cms_folder.'partner/registry/{id}', 'Lab\PartnerController@registry');
Route::put($cms_folder.'partner/settings/{id}', 'Lab\PartnerController@settings');

// Photogallery
Route::resource($cms_folder.'photo', 'Lab\PhotogalleryController');
Route::get($cms_folder.'photo/delete/img/{id}/{img}', 'Lab\PhotogalleryController@deleteImg');
Route::get($cms_folder.'photo/change/flag/{id}/{field}', 'Lab\PhotogalleryController@changeFlag');
Route::put($cms_folder.'photo/settings/{id}', 'Lab\PhotogalleryController@settings');

// Videogallery
Route::resource($cms_folder.'video', 'Lab\VideogalleryController');
Route::get($cms_folder.'video/delete/img/{id}/{img}', 'Lab\VideogalleryController@deleteImg');
Route::get($cms_folder.'video/change/flag/{id}/{field}', 'Lab\VideogalleryController@changeFlag');
Route::put($cms_folder.'video/settings/{id}', 'Lab\VideogalleryController@settings');

// Portfolio
Route::resource($cms_folder.'portfolio', 'Lab\PortfolioController');
Route::get($cms_folder.'portfolio/delete/img/{id}/{img}', 'Lab\PortfolioController@deleteImg');
Route::get($cms_folder.'portfolio/change/flag/{id}/{field}', 'Lab\PortfolioController@changeFlag');
Route::put($cms_folder.'portfolio/registry/{id}', 'Lab\PortfolioController@registry');
Route::put($cms_folder.'portfolio/settings/{id}', 'Lab\PortfolioController@settings');

// Category
Route::resource($cms_folder.'category', 'Lab\CategoryController');
Route::get($cms_folder.'category/delete/img/{id}/{img}', 'Lab\CategoryController@deleteImg');
Route::get($cms_folder.'category/change/flag/{id}/{field}', 'Lab\CategoryController@changeFlag');
Route::put($cms_folder.'category/settings/{id}', 'Lab\CategoryController@settings');

// Subcategory
Route::resource($cms_folder.'subcategory', 'Lab\SubcategoryController');
Route::get($cms_folder.'subcategory/delete/img/{id}/{img}', 'Lab\SubcategoryController@deleteImg');
Route::get($cms_folder.'subcategory/change/flag/{id}/{field}', 'Lab\SubcategoryController@changeFlag');
Route::put($cms_folder.'subcategory/settings/{id}', 'Lab\SubcategoryController@settings');

// Products
Route::resource($cms_folder.'products', 'Lab\ProductController');
Route::get($cms_folder.'products/delete/img/{id}/{img}', 'Lab\ProductController@deleteImg');
Route::get($cms_folder.'products/change/flag/{id}/{field}', 'Lab\ProductController@changeFlag');
Route::put($cms_folder.'products/settings/{id}', 'Lab\ProductController@settings');

// User
Route::resource($cms_folder.'user', 'Lab\UserController');
Route::get($cms_folder.'user/change/flag/{id}/{field}', 'Lab\UserController@changeFlag');
Route::put($cms_folder.'user/password/{id}', 'Lab\UserController@password');

// Upload
Route::get($cms_folder.'upload/{id}/edit/', 'Lab\UploadController@edit');
Route::get($cms_folder.'upload/{id}/{folder}', 'Lab\UploadController@index');
Route::get($cms_folder.'upload/change/flag/{id}/{field}', 'Lab\UploadController@changeFlag');
Route::delete($cms_folder.'upload/{id}', 'Lab\UploadController@delete');
Route::post($cms_folder.'upload/image/{id}/{table}/{folder}', 'Lab\UploadController@image');
Route::post($cms_folder.'upload/multiupload/{id}/{folder}', 'Lab\UploadController@multiupload');
Route::put($cms_folder.'upload/{id}', 'Lab\UploadController@update');
Route::put($cms_folder.'upload/settings/{id}', 'Lab\UploadController@settings');

// Product options
Route::resource($cms_folder.'po', 'Lab\ProductoptionController');
Route::get($cms_folder.'po/delete/img/{id}/{img}', 'Lab\ProductoptionController@deleteImg');
Route::get($cms_folder.'po/change/flag/{id}/{field}', 'Lab\ProductoptionController@changeFlag');
Route::put($cms_folder.'po/settings/{id}', 'Lab\ProductoptionController@settings');


// Order
Route::post($cms_folder.'order/{table}', 'Lab\OrderController@update');

// Parameters
Route::get($cms_folder.'parameter/{module2nd}', 'Lab\ParameterController@edit');
Route::put($cms_folder.'parameter', 'Lab\ParameterController@update');