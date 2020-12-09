<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefixes' => 'api'], function () {
Route::get('','ApiController@index');
Route::get('presentation','ApiController@listPresentation');
Route::post('auth','ApiController@authenticate');
Route::get('auth','ApiController@authenticate');
Route::get('user','ApiController@getUser');
Route::get('presentation/{id}','ApiController@getFile');
Route::post('views','ApiController@addViews');
Route::post('delai','ApiController@addDelay');
Route::post('question','ApiController@addQuestions');
Route::post('personnel/reset-password','ApiController@forgotPassword');
});