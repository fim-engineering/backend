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

Route::get('/', 'HomePageController@index');

/**
 * Validasi data peserta yang belum isi regional
 */
Route::get('/check-regional-null', 'MemberInfoController@get_person_who_not_fill_regional');

Route::get('/list-belum-isi-regional', 'MemberInfoController@list_index_peserta');
Route::get('/list-belum-submit-sayang-kalau-dibuang', 'MemberInfoController@list_index_peserta_submit_yet');


Route::get('/admin/add-record-broadcast', 'MemberInfoController@add_record_broadcast');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/seleksi-berkas', 'seleksiController@selectregional');
Route::any('/seleksi-berkas/list-peserta', 'seleksiController@view_list_member');
Route::any('/seleksi-berkas/list-peserta/delete', 'seleksiController@delete_member');

Route::any('/get-data-member', 'seleksiController@view_peserta');
