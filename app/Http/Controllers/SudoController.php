<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\position;
use App\models\regional;
use Illuminate\Support\Facades\DB;


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
}
