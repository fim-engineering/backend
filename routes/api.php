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

Route::get('/deletebagus', 'AuthController@deletebagus');

Route::group(['middleware' => ['api']],function(){

  Route::post('/signup', 'AuthController@signup');
  Route::post('/login', 'AuthController@login');
  Route::post('/logout', 'AuthController@logout');
  Route::post('/refresh', 'AuthController@refresh');
  Route::post('/activate', 'AuthController@activate');
  Route::post('/resend', 'AuthController@resend');
  Route::post('/change-password', 'AuthController@change_password');
  Route::post('/me', 'AuthController@me');

  /**
   * API list Institusi
   */

   Route::get('/institution-list', 'AuthController@institution');

   /**
    * masuk wilayah auth
    */

  Route::group(['middleware' =>['jwt.auth']], function(){

    Route::get('/tes','ProfilController@index');

    /**
     * RU untuk Data Diri Dasar Peserta
     */
     Route::get('/myprofile', 'ProfilController@index')->name('profil.index');
     Route::put('/myprofile/update', 'ProfilController@update')->name('profil.update');

     /**
      * RU untuk achievement Peserta
      */
      Route::get('/achievement','AchievementController@index')->name('achievement.index');
      Route::post('/achievement/create', 'AchievementController@create')->name('achievement.create');
      Route::get('/achievement/{id}/edit','AchievementController@edit')->name('achievement.edit');
      Route::put('/achievement/{id}/update','AchievementController@update')->name('achievement.update');
      Route::post('/achievement/{id}/delete','AchievementController@delete')->name('achievement.delete');

      // Quick Achievement

      Route::get('/achievementbest', 'AchievementBestController@index')->name('achievement.best.index');
      Route::post('/achievementbest/update','AchievementBestController@update')->name('achievement.best.update');

      /**
       * CRUD Regionals (DONE)
       */
      Route::get('/admin/regionals', 'RegionalController@index')->name('regional.index');
      Route::post('/admin/regionals/create','RegionalController@create')->name('regional.create');
      Route::post('/admin/regionals/edit','RegionalController@edit')->name('regional.edit');
      Route::put('/admin/regionals/update','RegionalController@update')->name('regional.update');
      Route::post('/admin/regionals/delete','RegionalController@delete')->name('regional.delete');

      /**
       * Basic Table
       */
      Route::get('/select/mbtis', 'TableSeederController@mbti')->name('list.mbti');
      Route::get('/select/fim-references', 'TableSeederController@fim_references')->name('list.fimreferences');
      Route::get('/select/best-performances', 'TableSeederController@best_performance')->name('list.best_performance');
      Route::get('/select/positions','TableSeederController@positions')->name('list.positions');

      /**
       * RD Personality
       */
      Route::get('/personality', 'PersonalityController@index')->name('personality.index');
      Route::put('/personality/update', 'PersonalityController@update')->name('personality.update');

      /**
       * RD Me and For Fim
       */
      Route::get('/meforfim', 'MeAndFimController@index')->name('forfim.index');
      Route::post('/meforfim/update','MeAndFimController@update')->name('forfim.update');


      /**
       * Route ForDeveloper
       */

      Route::get('/truncate/position', 'SudoController@position_truncate')->name('truncate.position');
      Route::get('/truncate/regional', 'SudoController@regional_truncate')->name('truncate.regional');



  });

});
