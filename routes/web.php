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
Route::prefix('producer')->group(function() {
	Route::get('/', 'Auth\LoginController@showLoginForm')->name('showLoginForm');
	Route::post('/', 'AuthController@login')->middleware('guest')->name('login');
	Route::get('/setadminuser', function(){
	if ((Auth::check()) && (Auth::user()->name == 'developer'))
	{
		return view('auth.register');
	}
	else
	{
		abort(404);
	}})->name('showRegistrationForm');
	Route::post('/setadminuser', 'AuthController@register')->middleware('auth')->name('register');
	Route::get('/logout', 'Auth\LoginController@logout')->name('logout');


	// Password Reset Routes...
	Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
	Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('reset');


});

Route::prefix('admin')->namespace('Admin')->middleware('admin')->group(function() {
	Route::get('/','DashboardController@index')->name('admin');
	Route::get('/search','DashboardController@search')->name('admin.search');
	Route::get('/category','DashboardController@edit_category_show')->name('edit.category.show');
	Route::resource('/posts','PostsController');
	Route::resource('/posts/gallery', 'GalleryController')->only(['edit', 'update', 'destroy']);
	Route::get('/posts/gallery/{id}/create', 'GalleryController@create')->name('gallery.create');
	Route::post('/posts/gallery/{id}/store', 'GalleryController@store')->name('gallery.store');
	Route::resource('/category', 'CategoryController')->only(['edit', 'update']);
});


Route::get('/', 'MainController@index')->name('index');
Route::get('/search', 'MainController@search')->name('search');
Route::get('/news/{id}', 'MainController@post')->name('post.show');
Route::get('/news', 'MainController@news')->name('news.show');
Route::get('/videos', 'MediaController@videos')->name('videos.show');
Route::get('/image', 'MediaController@images')->name('images.show');
Route::get('/reviews', 'MainController@reviews')->name('reviews.show');
Route::get('/{alias}', 'CategoryController@cat')->name('cat.show');
Route::get('/{alias}/news', 'CategoryController@news')->name('cat.news.show');
Route::get('/{alias}/videos', 'CategoryController@videos')->name('cat.videos.show');
Route::get('/{alias}/images', 'CategoryController@images')->name('cat.images.show');

