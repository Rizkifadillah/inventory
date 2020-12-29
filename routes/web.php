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
    return redirect('/beranda');});

Route::get('/keluar', function () {
    \Auth::logout();
    return redirect('/login');
});

Route::group(['middleware'=>'auth'],function(){
    Route::get('/supplier', 'Supplier_controller@index');
    Route::get('/supplier/add', 'Supplier_controller@add');
    Route::post('/supplier/add', 'Supplier_controller@store');
    Route::get('/supplier/{id}', 'Supplier_controller@edit');
    Route::put('/supplier/{id}', 'Supplier_controller@update');
    Route::delete('/supplier/{id}', 'Supplier_controller@delete');

    Route::get('/produk', 'Produk_controller@index');
    Route::get('/produk/add', 'Produk_controller@add');
    Route::post('/produk/add', 'Produk_controller@store');
    Route::get('/produk/{id}', 'Produk_controller@edit');
    Route::put('/produk/{id}', 'Produk_controller@update');
    Route::delete('/produk/{id}', 'Produk_controller@delete');
    Route::get('/produk/detail/{id}', 'Produk_controller@detail');

    Route::get('/po', 'Po_controller@index');
    Route::get('/po/add', 'Po_controller@add');
    Route::get('/po/produk/{supplier}', 'Po_controller@get_produk');
    Route::post('/po/add', 'Po_controller@store');
    Route::get('/po/approved/{id}', 'Po_controller@approved');
    Route::get('/po/detail/{id}', 'Po_controller@detail');
    Route::delete('/po/line/{id}', 'Po_controller@hapus_line');
    Route::put('/po/{id}', 'Po_controller@update');
    Route::get('/po/pdf/{id}', 'Po_controller@pdf');

    Route::get('gr', 'Gr_controller@index');
    Route::get('/gr/detail/{id}', 'Gr_controller@detail');
    Route::post('gr/{id}', 'Gr_controller@approved');

    Route::get('pos', 'Pos_controller@index');
    Route::post('pos', 'Pos_controller@store');
    Route::get('produk/ajax/{kode}', 'Pos_controller@get_produk');

    Route::get('sales', 'Sales_controller@index');
    Route::get('sales/periode', 'Sales_controller@periode');
    Route::get('/sales/detail/{id}', 'Sales_controller@detail');

    Route::get('update-perusahaan', 'Perusahaan_controller@index');
    Route::post('update-perusahaan2', 'Perusahaan_controller@update');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
