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


Auth::routes();


/********************************STEPS*****************************/
Route::post('step1', ['as' => 'step1', 'uses' => 'PdfController@step1']);
Route::post('step2', ['as' => 'step2', 'uses' => 'PdfController@step2']);
Route::post('step3', ['as' => 'step3', 'uses' => 'PdfController@step3']);

/******************************************************************/
Route::get('reset-password/{token}',['as' => 'reset.password', 'uses' => 'HomeController@resetPage']);

Route::post('reset-password',['as' => 'form.reset.password', 'uses' => 'HomeController@resetPassword']);






Route::get('/', 'HomeController@index');
Route::get('home', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::get('agenda','AgendaController@index');
/*
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);*/

Route::get('auth/login',['as' => 'auth.login', 'uses' => 'HomeController@login']);
Route::post('auth/login',['as' => 'auth.login', 'uses' => 'HomeController@PostLogin']);
Route::post('auth/logout',['as'=>'auth.logout','uses'=>'HomeController@logout']);


Route::resource('presentation', 'PresentationController');
//Route::resource('groupe', 'GroupeController');

Route::get('/config-cache', function() {
    Artisan::call('config:clear');
    return "config is cleared";
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
Route::resource('groupe', 'GroupeController');
Route::post('groupe_update',['as'=>'groupe.update','uses'=>'GroupeController@update']);
Route::post('groupe/{id}/linkUser','GroupeController@linkUser');
Route::get('groupe/{id}/unlinkUser/{uid}','GroupeController@unlinkUser');
Route::get('groupe/{id}/delete','GroupeController@destroy');
Route::post('delete_groupe', ['as' => 'delete_groupe', 'uses' => 'GroupeController@deleteGroupe']);
Route::post('delete_perso_groupe', ['as' => 'delete_perso_groupe', 'uses' => 'GroupeController@deletePersoGroupe']);

Route::get('presentationtable','PresentationController@tableView');
Route::post('presentation/{id}/updateZip','PresentationController@updateZip');
Route::post('data_presentation', ['as' => 'data_presentation', 'uses' => 'HomeController@getChartPresentation']);
Route::post('global_presentation', ['as' => 'global_presentation', 'uses' => 'HomeController@getGlobalChart']);
Route::post('slide_presentation', ['as' => 'slide_presentation', 'uses' => 'HomeController@getSlideChart']);
Route::post('store_presentation', ['as' => 'store_presentation', 'uses' => 'PresentationController@storePresentation']);
Route::get('presentation/{id}/download','PresentationController@downloadZip');
Route::post('presentation/{id}/linkUser','PresentationController@linkUser');
Route::get('presentation/{id}/unlinkUser/{uid}','PresentationController@unlinkUser');
Route::post('detach_perso_pres', ['as' => 'detach_perso_pres', 'uses' => 'PresentationController@unlinkPerso']);
Route::post('detach_groupe_pres', ['as' => 'detach_groupe_pres', 'uses' => 'PresentationController@unlinkPrezGroupe']);

Route::post('presentation/{id}/linkGroupe','PresentationController@linkGroupe');
Route::get('presentation/{id}/unlinkGroupe/{uid}','PresentationController@unlinkGroupe');

Route::get('presentation/{id}/delete','PresentationController@destroy');
Route::post('delete_pres', ['as' => 'delete_pres', 'uses' => 'PresentationController@deletePres']);


Route::get('personnel/{id}/delete','PersonnelController@destroy');

Route::get('presentation/{id}/views','PresentationController@views');

/*****************************PDF*********************************/

Route::post('pdf',['as' => 'pdf', 'uses' => 'PdfController@exportHtml']);
Route::get('pdf',['as' => 'pdf', 'uses' => 'PdfController@index']);

Route::post('presentation/{id}/linkGroupe','PresentationController@linkGroupe');
//Route::post('presentation/{id}/linkGroupe','PresentationController@linkGroupe');
Route::get('pdf',['as' => 'pdf', 'uses' => 'PdfController@index']);
/****************************** PERSONNEL*******************************/
Route::get('personnel',['as'=>'personnel','uses'=>'PersonnelController@index']);
Route::get('personnel/create',['as'=>'personnel.create','uses'=>'PersonnelController@create']);
Route::get('personnel/{id}/edit',['as'=>'personnel','uses'=>'PersonnelController@edit']);
Route::post('personnel_update',['as'=>'personnel.update','uses'=>'PersonnelController@update']);
Route::post('personnel_store',['as'=>'personnel.store','uses'=>'PersonnelController@store']);
Route::post('delete_perso', ['as' => 'delete_perso', 'uses' => 'PersonnelController@deletePerso']);
//Route::resource('personnel', 'PersonnelController');
/********************************PRODUCT****************************************/
Route::get('product',['as'=>'product','uses'=>'ProductController@index']);
Route::get('product/create',['as'=>'product.create','uses'=>'ProductController@create']);
Route::get('product/{id}/edit',['as'=>'product.edit','uses'=>'ProductController@edit']);
Route::post('product_update',['as'=>'product.update','uses'=>'ProductController@update']);
Route::post('product_store',['as'=>'product.store','uses'=>'ProductController@store']);
Route::get('product/{id}/delete',['as'=>'product.destroy','uses'=>'ProductController@destroy']);
Route::post('delete_prod', ['as' => 'delete_prod', 'uses' => 'ProductController@deleteProd']);

//Route::resource('product', 'ProductController');