<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     // return view('frontend.layouts.app');
//     return view('frontend.pages.index');
// });

Route::get('/', 'PagesController@index')->name('index');

// Route::get('/admin', function () {
//    // return view('backend.layouts.app');
// 	return view('backend.pages.index');
// });

Route::get('/books', 'BooksController@index')->name('books.index');
Route::get('/books/search', 'BooksController@search')->name('books.search');
Route::post('/books/advance-search', 'BooksController@advanceSearch')->name('books.searched.advance');
//Route::get('/books/single-book', 'BooksController@show')->name('books.show');
Route::get('/books/{slug}', 'BooksController@show')->name('books.show');
Route::get('/books/upload/new', 'BooksController@create')->name('books.upload');
Route::post('/books/upload/post', 'BooksController@store')->name('books.store');

Route::get('/books/categories/{slug}', 'CategoriesController@show')->name('categories.show');

Route::group(['prefix' => 'user'], function(){
	Route::get('/profile/{username}', 'UsersController@profile')->name('users.profile');
	Route::get('/profile/{username}/books', 'UsersController@books')->name('users.books');
});

Route::group(['prefix' => 'dashboard'], function(){
	Route::get('/', 'DashboardsController@index')->name('users.dashboard');
	Route::get('/books', 'DashboardsController@books')->name('users.dashboard.books');
	
	Route::get('/books/edit/{slug}', 'DashboardsController@bookEdit')->name('users.dashboard.books.edit');
	Route::post('/books/update/{slug}', 'DashboardsController@bookUpdate')->name('users.dashboard.books.update');
	Route::post('/books/delete/{slug}', 'DashboardsController@bookDelete')->name('users.dashboard.books.delete');

	Route::get('/books/request-list', 'DashboardsController@requestBookList')->name('books.request.list');	
	Route::post('/books/request/{slug}', 'DashboardsController@requestBook')->name('books.request');
	Route::post('/books/request-update/{id}', 'DashboardsController@requestBookUpdate')->name('books.request.update');
	Route::post('/books/request-delete/{id}', 'DashboardsController@requestBookDelete')->name('books.request.delete');

	Route::post('/books/request-reject/{id}', 'DashboardsController@requestBookReject')->name('books.request.reject');

	Route::post('/books/request-approve/{id}', 'DashboardsController@requestBookApprove')->name('books.request.approve');


  //order
	Route::get('/books/order-list', 'DashboardsController@orderBookList')->name('books.order.list');	
	

	Route::post('/books/order-reject/{id}', 'DashboardsController@orderBookReject')->name('books.order.reject');

	Route::post('/books/order-approve/{id}', 'DashboardsController@orderBookApprove')->name('books.order.approve');
});

Route::group(['prefix' => 'admin'], function(){
	Route::get('/', 'Backend\PagesController@index')->name('admin.index');

	Route::group(['prefix' => 'books'], function(){
		Route::get('/', 'Backend\BooksController@index')->name('admin.books.index');
		Route::get('/unapproved', 'Backend\BooksController@unapproved')->name('admin.books.unapproved');
		Route::get('/approved', 'Backend\BooksController@approved')->name('admin.books.approved');
		//Route::get('/{id}', 'Backend\BooksController@show')->name('admin.books.show');
		Route::get('/create', 'Backend\BooksController@create')->name('admin.books.create');
		Route::get('/edit/{id}', 'Backend\BooksController@edit')->name('admin.books.edit');

		Route::post('/store', 'Backend\BooksController@store')->name('admin.books.store');
		Route::post('/update/{id}', 'Backend\BooksController@update')->name('admin.books.update');
		Route::post('/delete/{id}', 'Backend\BooksController@destroy')->name('admin.books.delete');
		Route::post('/approve/{id}', 'Backend\BooksController@approve')->name('admin.books.approve');
		Route::post('/unapprove/{id}', 'Backend\BooksController@unapprove')->name('admin.books.unapprove');
	});

	Route::group(['prefix' => 'authors'], function(){
		Route::get('/', 'Backend\AuthorsController@index')->name('admin.authors.index');
		Route::post('/store', 'Backend\AuthorsController@store')->name('admin.authors.store');
		Route::get('/{id}', 'Backend\AuthorsController@show')->name('admin.authors.show');
		Route::post('/update/{id}', 'Backend\AuthorsController@update')->name('admin.authors.update');
		Route::post('/delete/{id}', 'Backend\AuthorsController@destroy')->name('admin.authors.delete');
	});

	Route::group(['prefix' => 'categories'], function(){
		Route::get('/', 'Backend\CategoriesController@index')->name('admin.categories.index');
		Route::post('/store', 'Backend\CategoriesController@store')->name('admin.categories.store');
		Route::get('/{id}', 'Backend\CategoriesController@show')->name('admin.categories.show');
		Route::post('/update/{id}', 'Backend\CategoriesController@update')->name('admin.categories.update');
		Route::post('/delete/{id}', 'Backend\CategoriesController@destroy')->name('admin.categories.delete');
	});

	Route::group(['prefix' => 'publishers'], function(){
		Route::get('/', 'Backend\PublishersController@index')->name('admin.publishers.index');
		Route::post('/store', 'Backend\PublishersController@store')->name('admin.publishers.store');
		Route::get('/{id}', 'Backend\PublishersController@show')->name('admin.publishers.show');
		Route::post('/update/{id}', 'Backend\PublishersController@update')->name('admin.publishers.update');
		Route::post('/delete/{id}', 'Backend\PublishersController@destroy')->name('admin.publishers.delete');
	});
});
Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

