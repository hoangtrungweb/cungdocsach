<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::pattern('id', '[0-9]+');
Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');

Route::get('the-loai/{alias}', array(
	'as' =>'category',
	'uses' =>'BookController@getItemByCategory'
));



Route::post('/', array(
	'as' =>'book.postFind',
	'uses' =>'BookController@postFind'
));

Route::get('tim-kiem', array(
	'as' =>'book.getfind',
	'uses' =>'BookController@getfind'
));



Route::get('{alias}', array(
	'as' =>'book.detail',
	'uses' =>'BookController@show'
));



Route::post('sach/yeu-cau-muon', array(
	'as' =>'book.bookrequest',
	'uses' =>'BookController@bookrequest'
));



Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);



Route::group(['middleware' => 'auth'], function() {

	// Route::post('sach/xu-ly-cho-muon', array(
	// 	'as' =>'book.handleborrow',
	// 	'uses' =>'BookController@handleborrow'
	// ));

	Route::post('sach/xu-ly-cho-muon', array(
		'as' =>'book.handleborrowload',
		'uses' =>'BookController@handleborrowload'
	));

	Route::get('sach/them-moi', array(
		'as' =>'book.create',
		'uses' =>'BookController@getCreate'
	));

	Route::post('sach/them-moi', array(
		'as' =>'book.create',
		'uses' =>'BookController@postCreate'
	));

	Route::get('sach/quan-ly-muon-tra', array(
	'as' =>'book.borrowpaydetail',
	'uses' =>'BookController@borrowpaydetail'
	));



	Route::get('sach/tu-sach-cua-toi', array(
		'as' =>'book.mycloset',
		'uses' =>'BookController@mycloset'
	));

	Route::get('sach/{id}/chinh-sua', array(
		'as' =>'book.getedit',
		'uses' =>'BookController@getedit'
	));

	Route::post('sach/{id}/chinh-sua', array(
		'as' =>'book.postedit',
		'uses' =>'BookController@postedit'
	));



});
