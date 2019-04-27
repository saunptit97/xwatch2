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

Route::prefix('')->group(function(){
    Route::get('/', [
        'uses' =>'IndexController@index',
        'as' => 'home'
    ]);

    Route::get('type/{route}', 'IndexController@pages');

    Route::get('product/{url}', 'IndexController@getDetailProduct');

    Route::get('cart', 'IndexController@cart');
    Route::get('customer/account', 'CustomerAccount@index');
    Route::get('add-to-cart/{id}', 'IndexController@addToCart');
    Route::get('update-cart/{id}', 'IndexController@updateCart');
    Route::get('delete-cart/{id}', 'IndexController@deleteCart');
    Route::get('destroy-cart', 'IndexController@destroyCart');
    Route::get('checkout', 'IndexController@checkout');
    Route::post('process-checkout','IndexController@postCheckOut');
    Route::get('paypal', function(){
        return view('frontend.pages.paypal');
    });
    Route::post('paypalpost',[
        'uses'=>  'PaymentController@payWithpaypal',
        'as' => 'paypal'
        ]);
    Route::get('status', [
        'uses'=> 'PaymentController@getPaymentStatus',
        'as' => 'status'
        ]);
    Route::get('cart-index', '
        IndexController@indexCart');
    Route::get('auth/google', 'Auth\LoginController@redirectToProvider');

    Route::get('auth/google/callback', 'Auth\LoginController@handleProviderCallback');
});

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
     	return view('admin.pages.home');
    });

    Route::prefix('category')->group(function(){
        Route::get('/', [
            'uses' => 'CategoryController@all',
            'as' => 'category'
        ]);
        Route::get('/create','CategoryController@create');
        Route::post('/create',['uses' => 'CategoryController@createpost']);
        Route::get('/edit/{id}','CategoryController@edit');
        Route::post('/update/{id}','CategoryController@update');
        Route::get('/delete/{id}',[
            'uses' => 'CategoryController@delete'
        ]);

    });

    Route::prefix('brand')->group(function(){
        Route::get('/', [
            'uses' => 'BrandController@all',
            'as' => 'brand'
        ]);
        Route::get('/create', 'BrandController@create');
        Route::post('/create',[
            'uses' => 'BrandController@createpost'
        ]);
        Route::get('/edit/{id}','BrandController@edit');
        Route::post('/update/{id}',[
            'uses' => 'BrandController@update'
        ]);
        Route::get('/delete/{id}',[
            'uses' => 'BrandController@delete'
        ]);
    });

    Route::prefix('product')->group(function(){
        Route::get('/', [
            'uses' => 'ProductController@all',
            'as' => 'product'
        ]);
        Route::get('/create', 'ProductController@create');
        Route::post('/create','ProductController@createpost');
        Route::get('/show/{id}','ProductController@show');
        Route::post('/update/{id}', 'ProductController@update');
        Route::get('/delete/{id}', 'ProductController@delete');
    });

    Route::get('/contact', function(){
    	return view('admin.pages.contact');
    });
    Route::prefix('order')->group(function(){
        Route::get('/',[
            'as' => 'order',
            'uses' => 'OrderController@index'
        ]);
        Route::get('/{id}',[
            'as' => 'detail_order',
            'uses' => 'OrderController@getOrder'
        ]);
        Route::get('/invoice/{id}', 'OrderController@getInvoice');
        Route::get('/shipping/{id}', 'OrderController@getShipping');
    });
    Route::get('/contact/{id}', function(){
    	return view('admin.pages.read_mail');
    });
});

