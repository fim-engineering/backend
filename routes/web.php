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
