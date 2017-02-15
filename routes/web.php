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

// News
Route::resource($cms_folder.'service', 'Lab\ServiceController');
Route::get($cms_folder.'service/delete/img/{id}/{img}', 'Lab\ServiceController@deleteImg');
Route::get($cms_folder.'service/change/flag/{id}/{field}', 'Lab\ServiceController@changeFlag');
Route::put($cms_folder.'service/settings/{id}', 'Lab\ServiceController@settings');

// Upload
Route::get($cms_folder.'upload/{id}/{folder}', 'Lab\UploadController@index');
Route::get($cms_folder.'upload/{id}/edit/', 'Lab\UploadController@edit');
Route::get($cms_folder.'upload/change/flag/{id}/{field}', 'Lab\UploadController@changeFlag');
Route::delete($cms_folder.'upload/{id}', 'Lab\UploadController@delete');
Route::post($cms_folder.'upload/image/{id}/{table}/{folder}', 'Lab\UploadController@image');
Route::post($cms_folder.'upload/multiupload/{id}/{folder}', 'Lab\UploadController@multiupload');
Route::put($cms_folder.'upload/{id}', 'Lab\UploadController@update');
Route::put($cms_folder.'upload/settings/{id}', 'Lab\UploadController@settings');

// Order
Route::post($cms_folder.'order/{table}', 'Lab\OrderController@update');

// Parameters
Route::get($cms_folder.'parameter/{module2nd}', 'Lab\ParameterController@edit');
Route::put($cms_folder.'parameter', 'Lab\ParameterController@update');