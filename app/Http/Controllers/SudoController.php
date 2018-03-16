<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\position;
use App\models\regional;
use App\models\profile;
use Illuminate\Support\Facades\DB;
use App\User;
use App\models\institution;


class SudoController extends Controller
{
    public function position_truncate()
    {
      $delete = position::all();
      foreach ($delete as $key => $value) {
        $value->delete();
      }
      dd($delete);

    }

    public function institution_truncate()
    {
      $delete = institution::all();
      foreach ($delete as $key => $value) {
        $value->delete();
      }
      dd($delete);
    }

    public function regional_truncate()
    {
      $delete = regional::all();
      foreach ($delete as $key => $value) {
        $value->delete();
      }
      dd($delete);
    }

    public function empty_database()
    {
      $delete = user::all();
      foreach ($delete as $key => $user) {
        $profile      = $user->profiles;
        if ($profile     !== null) {
          $profile->delete();
        }
        $achievement  = $user->achievement_bests;
        if ($achievement !== null) {
          $achievement->delete();
        }
        $personality  = $user->personality;
        if ($personality !== null) {
          $personality->delete();
        }
        $meandfim     = $user->me_and_fim;
        if ($meandfim    !== null) {
          $meandfim->delete();
        }

        $user->delete();
      }

      dd($delete);
    }

    public function encode_keyword()
    {
      $encode = User::all();
      foreach ($encode as $key => $user) {
        $pswd = $user->keyword;
        $user->keyword= base64_decode($pswd);
        $user->save();
      }

      dd("Berhasil Ubah base64_encode");
    }

    public function caripeserta(Request $request)
    {
      $user = $request->json('nama_peserta');
      $all_user = DB::table('users')->where('name','like', '%'.$user.'%')
         ->join('profiles', 'users.id', '=', 'profiles.user_id')
         ->join('achievement_bests', 'users.id', '=', 'achievement_bests.user_id')
         ->join('me_and_fims', 'users.id', '=', 'me_and_fims.user_id')
         ->join('personalities', 'users.id', '=', 'personalities.user_id')
         ->first();

         return response()->json([
           'user_data' => $all_user,
           'code' => 200,
         ]);
    }
}
