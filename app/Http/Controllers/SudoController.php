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

    public function ciamis_pangandaran()
    {
      $regional= regional::where('regional_name', 'Pangandaran *')->first();
      $regional->regional_name = "Ciamis *";
      $regional->save();

      $profiles = profile::where('city', 'Pangandaran *')->get();
      foreach ($profiles as $key => $profile) {
        $profile->city = "Ciamis *";
        $profile->save();
      }

      $add_pang = new regional;
      $add_pang->regional_name = "Pangandaran *";
      $add_pang->save();

      dd("Berhasil Ubah ke Ciamis dan Tambah Pangandaran");
    }
}
