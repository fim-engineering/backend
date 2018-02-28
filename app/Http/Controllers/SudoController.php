<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\position;
use App\models\regional;
use Illuminate\Support\Facades\DB;
use App\User;


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
}
