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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/', 'HomeUnauthController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/product/{id}', 'HomeUnauthController@show');
Route::post('/checkout', 'CheckoutController@index');
Route::get('/kota/{id}', 'CheckoutController@getCities');
Route::post('/ongkir', 'CheckoutController@submit');
Route::post('/beli', 'TransactionController@store');
Route::get('/transaksi/{id}', 'TransactionController@index');
Route::get('/transaksi/detail/{id}', 'TransactionDetailController@index');
Route::post('/transaksi/detail/status', 'TransactionDetailController@membatalkanPesanan');
Route::post('/transaksi/detail/proof', 'TransactionDetailController@uploadProof');
Route::post('/transaksi/detail/review', 'ProductReviewController@store');
Route::get('/cart', 'CartController@show');
Route::post('/tambah_cart', 'CartController@store');
Route::post('/update_qty', 'CartController@update');
Route::post('/show_categori', 'HomeUnauthController@show_kategori');
Route::post('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('admin')->group(function () {
    // Dashboard route
    Route::get('/', 'AdminController@index')->name('admin.dashboard');

    // Login routes
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

    // Logout routenyah
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    // Register routes
    Route::get('/register', 'Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');
    Route::post('/register', 'Auth\AdminRegisterController@register')->name('admin.register.submit');

    // Password reset routes
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');

    // Detail transaksi
    Route::get('/transaksi','AdminTransaksiController@index')->name('admin.transaksi');
    Route::get('/transaksi/detail/{id}','AdminDetailTransaksiController@index')->name('admin.detail_transaksi');
    Route::post('/transaksi/detail/status', 'AdminDetailTransaksiController@membatalkanPesanan');
    Route::post('/transaksi/detail/review', 'ResponseController@create');
    Route::get('/marknotifadmin', 'AdminController@markReadAdmin');

    Route::post('/transaksi/sort', 'AdminTransaksiController@sort');
    Route::post('/report-bulan', 'AdminTransaksiController@filterBulan');
    Route::post('/report-tahun', 'AdminTransaksiController@filterTahun');
    Route::post('/grafik', 'AdminTransaksiController@grafik');
});


// Product
Route::resource('/products','ProductController')->middleware('auth:admin');
Route::get('/{id}/edit', 'ProductController@edit')->name('product.edit')->middleware('auth:admin');
Route::get('/{id}/update', 'ProductController@update')->name('product.edit')->middleware('auth:admin');
Route::post('/{id}/update', 'ProductController@update')->name('product.edit')->middleware('auth:admin');
Route::put('/{id}/update', 'ProductController@update')->name('product.update')->middleware('auth:admin');
Route::post('/{id}/add_image', 'ProductController@add_image')->name('product.add_image')->middleware('auth:admin');
Route::delete('/{id}/delete_image', 'ProductController@delete_image')->name('product.delete_image')->middleware('auth:admin');
Route::post('/{id}/add_cat', 'ProductController@add_cat')->name('product.add_cat')->middleware('auth:admin');
Route::delete('/{id}/delete_cat', 'ProductController@delete_cat')->name('product.delete_cat')->middleware('auth:admin');

// Categories
Route::resource('/categories','ProductCategoriesController')->middleware('auth:admin');

// Response
Route::prefix('admin/response')->group(function () {
    Route::get('/', 'ResponseController@index')->name('admin.response')->middleware('auth:admin');
    Route::get('/add', 'ResponseController@create')->name('response.add')->middleware('auth:admin');
    Route::get('/{review}/add', 'ResponseController@add_response')->name('response.add_response')->middleware('auth:admin');
    Route::get('/{response}/edit', 'ResponseController@edit')->name('response.edit')->middleware('auth:admin');
    Route::post('/store', 'ResponseController@store')->name('response.store')->middleware('auth:admin');
    Route::put('/{id}/update', 'ResponseController@update')->name('response.update')->middleware('auth:admin');
    Route::delete('/{id}', 'ResponseController@destroy')->name('response.destroy')->middleware('auth:admin');
});

// Discount
Route::prefix('admin/discount')->group(function () {
    Route::get('/', 'DiscountController@index')->name('admin.discount')->middleware('auth:admin');
    Route::get('/add/{id}', 'DiscountController@create')->name('discount.add')->middleware('auth:admin');
    Route::get('/{discount}/edit', 'DiscountController@edit')->name('discount.edit')->middleware('auth:admin');
    Route::post('/store', 'DiscountController@store')->name('discount.store')->middleware('auth:admin');
    Route::put('/{id}/update', 'DiscountController@update')->name('discount.update')->middleware('auth:admin');
    Route::delete('/{id}', 'DiscountController@destroy')->name('discount.destroy')->middleware('auth:admin');
});
