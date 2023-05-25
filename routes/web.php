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

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('login-user', function () {
    return view('login/index');
})->name('login-user');

Route::get('daftar-login', function () {
    return view('login/daftar');
});
Route::post('login-user','Auth\LoginController@login')->name('loginpost');
Route::post('daftar-login','Auth\RegisterController@showRegistrationForm')->name('register-create');




// HOMEE
Route::get('/', 'IndexController@index')->name('index');
// ABOUT
Route::get('about', 'IndexController@about')->name('about');

// INI MIDDLEWARE ADMIN
// DASHBOARD ADMIN
Route::resource('admin/dashboard','AdminController')->middleware('admin');
Route::get('admin/dashboard', 'AdminController@index')->name('admin/dashboard')->middleware('admin');

Route::get('admin/pmdk', 'AdminController@pmdk')->name('admin/pmdk');
Route::get('admin/usm1', 'AdminController@usm1')->name('admin/usm1');
Route::get('admin/usm2', 'AdminController@usm2')->name('admin/usm2');
Route::get('admin/usm3', 'AdminController@usm3')->name('admin/usm3');
Route::get('admin/utbk', 'AdminController@utbk')->name('admin/utbk');
Route::get('admin/prodi', 'AdminController@prodi')->name('admin/prodi');
Route::get('admin/asal', 'AdminController@asal')->name('admin/asal');
Route::get('admin/akreditasi', 'AdminController@akreditasi')->name('admin/akreditasi');

// USER
Route::resource('admin/user', 'UserController')->middleware('admin');
Route::get('admin/user/{id}/profile', 'UserController@showing')->name('user.showing')->middleware('admin');
Route::get('admin/user/create', 'UserController@create')->name('tambah-user')->middleware('admin');
Route::post('admin/user/create', 'UserController@store')->name('create-user')->middleware('admin');
// Accounting
Route::resource('admin/accounting', 'AccountingController')->middleware('admin');
Route::get('admin/accounting/{id}/show', 'AccountingController@showingaccounting')->name('accounting.showing')->middleware('admin');
Route::get('admin/accounting/{id}/ubah-accounting', 'AccountingController@profile')->name('accounting.edit')->middleware('admin');
Route::post('admin/accounting/{id}/ubah-accounting', 'AccountingController@updatedong')->name('accounting-update')->middleware('admin');
// Warehouse
Route::resource('admin/warehouse', 'WarehouseController')->middleware('admin');
Route::get('admin/warehouse/{id}/show', 'WarehouseController@showingwarehouse')->name('warehouse.showing')->middleware('admin');
Route::get('admin/warehouse/{id}/ubah-warehouse', 'WarehouseController@profile')->name('warehouse.edit')->middleware('admin');
Route::post('admin/warehouse/{id}/ubah-warehouse', 'WarehouseController@updatedong')->name('warehouse-update')->middleware('admin');
// Procumerent
Route::resource('admin/procumerent', 'ProcumerentController')->middleware('admin');
Route::get('admin/procumerent/{id}/show', 'ProcumerentController@showingprocumerent')->name('procumerent.showing')->middleware('admin');
Route::get('admin/procumerent/{id}/ubah-procumerent', 'ProcumerentController@profile')->name('procumerent.edit')->middleware('admin');
Route::post('admin/procumerent/{id}/ubah-procumerent', 'ProcumerentController@updatedong')->name('procumerent-update')->middleware('admin');

// Vendor
Route::resource('admin/vendor', 'VendorController')->middleware('admin');
Route::get('admin/vendor/{id}/show', 'VendorController@showingvendor')->name('vendor.showing')->middleware('admin');
Route::get('admin/vendor/{id}/ubah-vendor', 'VendorController@profile')->name('vendor.edit')->middleware('admin');
Route::post('admin/vendor/{id}/ubah-vendor', 'VendorController@updatedong')->name('vendor-update')->middleware('admin');

// // INI MIDDLEWARE Accounting
// // DASHBOARD

// // INI MIDDLEWARE Vendor
Route::get('vendor/dashboard', 'VendorController@index2')->name('vendor/dashboard');

Route::get('vendor/pmdk', 'VendorController@pmdk')->name('vendor/pmdk');
Route::get('vendor/usm1', 'VendorController@usm1')->name('vendor/usm1');
Route::get('vendor/usm2', 'VendorController@usm2')->name('vendor/usm2');
Route::get('vendor/usm3', 'VendorController@usm3')->name('vendor/usm3');
Route::get('vendor/utbk', 'VendorController@utbk')->name('vendor/utbk');

Route::get('vendor/prodi', 'VendorController@prodi')->name('vendor/prodi');
Route::get('vendor/asal', 'VendorController@asal')->name('vendor/asal');
Route::get('vendor/akreditasi', 'VendorController@akreditasi')->name('vendor/akreditasi');

Route::get('vendor/user/{id}/show', 'VendorController@showing')->name('vendor-user.show');
Route::get('vendor/user/{id}/profile', 'VendorController@show')->name('vendor-user.showing');
Route::put('vendor/{id}/profile','VendorController@heyupdate')->name('update-vendor');
Route::post('vendor/{id}/password','VendorController@editpass')->name('update-pass-vendor');
