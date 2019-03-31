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

Route::get('/', 'booksController@show');  //начальная страница со всеми книгами
Route::get('/book/{id}', 'booksController@index'); //страница книги

Route::resource('/images','ImageController');
// Route::get('/', function () {
//     return view('start');
// });
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');//лк пользователя
Route::get('/home/update', 'HomeController@update');//лк пользователя -> изменение данных
Route::post('/home/edit','HomeController@edit');//лк пользователя -> сохранение измененных данных
Route::get('/home/addtocart/{id}', 'HomeController@addtocard');//лк -> добавление в корзину
Route::get('/home/deleteincart/{id}', 'HomeController@deleteoneincart');//лк-> удаление 1шт товара в карзине
Route::get('/home/deleteoneproductincart/{id}', 'HomeController@removeincart');//лк-> удаление 1 наименования товара в карзине
Route::get('/home/checkout', 'HomeController@getCheckout');//лк-> отображение формы заказа
Route::post('/home/checkout', 'HomeController@saveOrder');//лк-> 
Route::get('/home/cart', 'HomeController@getCart')->name('card'); //корзина
//админка
Route::group(['middleware' => 'auth', 'middleware' => 'access:admin'], function () {
  Route::get('/admin', 'AdminController@index')->name('admin');//->админка
  Route::get('/admin/orders', 'AdminController@orders');//->список всех заказов за последний месяц
  Route::get('/admin/createbook', 'AdminController@newbook');//->добавление новой книги(фото)
  Route::post('/admin/savephoto','AdminController@store');//->сохранение фото новой книги
  Route::get('/admin/createcardbook', 'AdminController@createcardbook')->name('newcard');//->создание карты новой книги
  Route::post('/admin/savebook','AdminController@createsave');//->сохранение новой книги
  Route::get('/admin/constbookaut','AdminController@createconst')->name('addauth');//->создание связи книги и автора
  Route::get('/admin/createnewaut','AdminController@createnewaut');//->создание нового автора
  Route::post('/admin/saveauth','AdminController@saveauth');//->сохранение нового автора
  Route::post('/admin/saveconstab','AdminController@saveconstab');//->сохранение новой связи автор книга
  Route::get('/admin/updatebook/{id}','AdminController@updatebook');//->вносим изменения в книгу
  Route::post('/admin/updatebook/save/{id}', 'AdminController@updatebooksave');//сохранение измененией данных о книге
  Route::post('/admin/delete/{id}', 'AdminController@deletebook');//удаление книги
  Route::get('/admin/seeorder/{id}', 'AdminController@seeorder');//подобнее о заказе
});
