<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\regional;

class seleksiController extends Controller
{
    //

    public function selectregional()
    {
      $regional = regional::OrderBy('regional_name','asc')->get();

      $data = array('regionals' =>$regional , );

      return view('select-regional')->with($data);
    }
}
