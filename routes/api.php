<?php

use Illuminate\Http\Request;

// /*
// |--------------------------------------------------------------------------
// | API Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register API routes for your application. These
// | routes are loaded by the RouteServiceProvider within a group which
// | is assigned the "api" middleware group. Enjoy building your API!
// |
// */
//
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['api']],function(){

  Route::post('/signup', 'AuthController@signup');
  Route::post('/login', 'AuthController@login');
  Route::post('/logout', 'AuthController@logout');
  Route::post('/refresh', 'AuthController@refresh');
  Route::post('/activate', 'AuthController@activate');
  Route::post('/me', 'AuthController@me');

  Route::group(['middleware' =>['jwt.auth']], function(){

    Route::get('/tes','ProfilController@index');

    /**
     * RU untuk Data Diri Dasar Peserta
     */
     Route::get('/myprofile', 'ProfilController@index')->name('profil.index');
     Route::put('/myprofile/update', 'ProfilController@update')->name('profil.update');



  });

});
