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
    return view('ArticleController@index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users','UserController');

Route::resource('products','ProductController');

Route::resource('tickets','TicketController');


Route::get('addmoney/stripe', array('as' => 'addmoney.paywithstripe','uses' => 'AddMoneyController@payWithStripe'));
Route::post('addmoney/stripe', array('as' => 'addmoney.stripe','uses' => 'AddMoneyController@postPaymentWithStripe'));

Route::get('/pdfview', 'PdfGenerateController@pdfview');
Route::get('generate-pdf', 'PdfGenerateController@pdfview')->name('generate-pdf');




Route::resource('articles','ArticleController');

Route::get('article','ArticleController@index');



Route::post('getarticle','ArticleController@getarticle'); 

Route::post('getarticlebydomain','ArticleController@getarticlebydomain');