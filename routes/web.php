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