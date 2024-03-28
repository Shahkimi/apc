<?php

Route::get('/snappy', function () {
    $pdf = App::make('snappy.pdf.wrapper');
    $html = '<h1>Norlaili </h1>';

    $pdf->generateFromHtml($html, 'hello.pdf');
    $pdf->inline(); 
});
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

// echo "laili sobki";

// Route::get('/', function () {
//     // return view('welcome');
//     return view('welcome');
// });

Route::get('/try', function () {
    return view('trytry');
});



//Route::get('/pizzas', 'PizzaController@index' );
//Route::get('/pizzas', 'PizzaController@index' )->middleware('auth');
//share

Route::get('/', 'HomeController@index');
Route::get('/getBahagian/{id}','GuestController@getBahagian')->name('getBahagian');
Route::post('/share', 'GuestController@store')->name('guest.store');

Route::get('/apc', 'ApcController@index')->name('apc.index')->middleware('auth');
Route::get('apc/create', 'ApcController@create')->name('apc.create')->middleware('auth');
Route::post('/apc', 'ApcController@store')->name('apc.store');
Route::get('/apc/show/{id}', 'ApcController@show' )->name('apc.show')->middleware('auth');
Route::get('/apc/edit/{id}', 'ApcController@edit' )->name('apc.edit')->middleware('auth');
Route::delete('/apc/{id}', 'ApcController@destroy' )->name('apc.destroy')->middleware('auth');
Route::post('/apc/edit', 'ApcController@update')->middleware('auth');
Route::get('/apc/search', 'ApcController@search')->middleware('auth');
Route::get('/apc/confirm_update/{id}', 'ApcController@confirm_update')->middleware('auth');
Route::get('/apc/sah_kehadiran/{id}', 'ApcController@sah_kehadiran')->middleware('auth');
Route::get('/apc/getNoLewat/{id}', 'ApcController@getNoLewat')->middleware('auth');
Route::get('/apc/paparan', 'ApcController@paparan')->middleware('auth');

Route::get('sesi', 'SesiController@index')->name('sesi.index')->middleware('auth');
Route::get('sesi/create', 'SesiController@create')->name('sesi.create')->middleware('auth');
Route::post('/sesi', 'SesiController@store')->name('sesi.store');
Route::get('/sesi/show/{id}', 'SesiController@show' )->name('sesi.show')->middleware('auth');
Route::get('/sesi/edit/{id}', 'SesiController@edit' )->name('sesi.edit')->middleware('auth');
Route::delete('/sesi/{id}', 'SesiController@destroy' )->name('sesi.destroy')->middleware('auth');
Route::post('/sesi/edit', 'SesiController@update')->middleware('auth');

Route::get('/laporan/hadir/{sesi}/{jenis}', 'LaporanController@hadir')->name('laporan_hadir')->middleware('auth');
Route::get('/laporan/hadirPDF', 'LaporanController@hadirPDF')->middleware('auth');
Route::get('/laporan/importExportView', 'LaporanController@importExportView');
Route::get('/laporan/export', 'LaporanController@export')->name('export');
Route::post('/laporan/import', 'LaporanController@import')->name('import');
Route::get('/laporan/exportPegawai', 'LaporanController@exportPegawai')->name('export');

Route::get('/senarai', 'ShareController@index')->name('share.index')->middleware('auth');
Route::get('/share/edit/{id}', 'ShareController@edit' )->name('share.edit')->middleware('auth'); 
Route::post('/share/update', 'ShareController@update')->middleware('auth');
Route::delete('/share/{id}', 'ShareController@destroy' )->name('share.destroy')->middleware('auth');

Route::get('/send-mail','GuestController@sendMail');

//penyelaras
Route::get('penyelaras', 'PenyelarasController@index')->name('penyelaras.index')->middleware('auth');
Route::get('penyelaras/create', 'PenyelarasController@create')->name('penyelaras.create')->middleware('auth');
Route::post('/penyelaras', 'PenyelarasController@store')->name('penyelaras.store');
Route::get('/penyelaras/show/{id}', 'PenyelarasController@show' )->name('penyelaras.show')->middleware('auth');
Route::get('/penyelaras/edit/{id}', 'PenyelarasController@edit' )->name('penyelaras.edit')->middleware('auth');
Route::delete('/penyelaras/{id}', 'PenyelarasController@destroy' )->name('penyelaras.destroy')->middleware('auth');
Route::post('/penyelaras/edit', 'PenyelarasController@update')->middleware('auth');
Route::get('/penyelaras/search', 'PenyelarasController@search')->middleware('auth');

//kawalan
Route::get('bahagian', 'BahagianController@index')->name('bahagian.index')->middleware('can:manage-users');
Route::get('bahagian/create', 'BahagianController@create')->name('bahagian.create')->middleware('auth');
Route::post('/bahagian', 'BahagianController@store')->name('bahagian.store');
Route::get('/bahagian/show/{id}', 'BahagianController@show' )->name('bahagian.show')->middleware('auth');
Route::get('/bahagian/edit/{id}', 'BahagianController@edit' )->name('bahagian.edit')->middleware('auth');
Route::delete('/bahagian/{id}', 'BahagianController@destroy' )->name('bahagian.destroy')->middleware('auth');
Route::post('/bahagian/edit', 'BahagianController@update')->middleware('auth');
Route::get('/bahagian/search', 'BahagianController@search')->middleware('auth');

Route::get('ptj', 'PtjController@index')->name('ptj.index')->middleware('auth');
Route::get('ptj/create', 'PtjController@create')->name('ptj.create')->middleware('auth');
Route::post('/ptj', 'PtjController@store')->name('ptj.store');
Route::get('/ptj/show/{id}', 'PtjController@show' )->name('ptj.show')->middleware('auth');
Route::get('/ptj/edit/{id}', 'PtjController@edit' )->name('ptj.edit')->middleware('auth');
Route::delete('/ptj/{id}', 'PtjController@destroy' )->name('ptj.destroy')->middleware('auth');
Route::post('/ptj/edit', 'PtjController@update')->middleware('auth');
Route::get('/ptj/search', 'PtjController@search')->middleware('auth');

Route::get('jawatan', 'JawatanController@index')->name('jawatan.index')->middleware('auth');
Route::get('jawatan/create', 'JawatanController@create')->name('jawatan.create')->middleware('auth');
Route::post('/jawatan', 'JawatanController@store')->name('jawatan.store');
Route::get('/jawatan/show/{id}', 'JawatanController@show' )->name('jawatan.show')->middleware('auth');
Route::get('/jawatan/edit/{id}', 'JawatanController@edit' )->name('jawatan.edit')->middleware('auth');
Route::delete('/jawatan/{id}', 'JawatanController@destroy' )->name('jawatan.destroy')->middleware('auth');
Route::post('/jawatan/edit', 'JawatanController@update')->middleware('auth');
Route::get('/jawatan/search', 'JawatanController@search')->middleware('auth');

Route::get('gred', 'GredController@index')->name('gred.index')->middleware('auth');
Route::get('gred/create', 'GredController@create')->name('gred.create')->middleware('auth');
Route::post('/gred', 'GredController@store')->name('gred.store');
Route::get('/gred/show/{id}', 'GredController@show' )->name('gred.show')->middleware('auth');
Route::get('/gred/edit/{id}', 'GredController@edit' )->name('gred.edit')->middleware('auth');
Route::delete('/gred/{id}', 'GredController@destroy' )->name('gred.destroy')->middleware('auth');
Route::post('/gred/edit', 'GredController@update')->middleware('auth');
Route::get('/gred/search', 'GredController@search')->middleware('auth');

Route::get('status', 'StatusController@index')->name('status.index')->middleware('auth');
Route::get('status/create', 'StatusController@create')->name('status.create')->middleware('auth');
Route::post('/status', 'StatusController@store')->name('status.store');
Route::get('/status/show/{id}', 'StatusController@show' )->name('status.show')->middleware('auth');
Route::get('/status/edit/{id}', 'StatusController@edit' )->name('status.edit')->middleware('auth');
Route::delete('/status/{id}', 'StatusController@destroy' )->name('status.destroy')->middleware('auth');
Route::post('/status/edit', 'StatusController@update')->middleware('auth');
Route::get('/status/search', 'StatusController@search')->middleware('auth');

Route::get('role', 'RoleController@index')->name('role.index')->middleware('auth');
Route::get('role/create', 'RoleController@create')->name('role.create')->middleware('auth');
Route::post('/role', 'RoleController@store')->name('role.store');
Route::get('/role/show/{id}', 'RoleController@show' )->name('role.show')->middleware('auth');
Route::get('/role/edit/{id}', 'RoleController@edit' )->name('role.edit')->middleware('auth');
Route::delete('/role/{id}', 'RoleController@destroy' )->name('role.destroy')->middleware('auth');
Route::post('/role/edit', 'RoleController@update')->middleware('auth');
Route::get('/role/search', 'RoleController@search')->middleware('auth');


//Auth::routes();
Auth::routes([
	'register' => false
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('change-password', 'ChangePasswordController@index')->name('change.password');
//Route::post('change-password', 'ChangePasswordController@changePassword');

Route::get('password', 'ChangePasswordController@index')->name('password.edit');
Route::post('password', 'ChangePasswordController@changePassword');

Route::namespace('Admin')
->prefix('admin')
->name('admin.')
->group(function(){
	Route::resource('/users','UsersController',['except' => ['show']]);
});

Route::get('/admin/users/search', 'Admin\UsersController@search')->middleware('auth');




