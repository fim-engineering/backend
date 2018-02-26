<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\mbti;
use App\models\fim_info_reference;
use App\models\best_performance;
use App\models\position;

class TableSeederController extends Controller
{
    public function mbti()
    {
      $mbti = mbti::all()->pluck('mbti_type');

      return response()->json([
        'mbti' =>$mbti,
        'code'=> 200,
      ]);
    }

    public function fim_references()
    {
      $fim_references = fim_info_reference::all()->pluck('references');

      return response()->json([
        'fim_references' =>$fim_references,
        'code'=> 200,
      ]);
    }

    public function best_performance()
    {
      $best_performance = best_performance::all()->pluck('type');

      return response()->json([
        'best_performance' =>$best_performance,
        'code'=> 200,
      ]);
    }

    public function positions()
    {
      $position = position::all()->pluck('position_name');

      return response()->json([
        'position' =>$position,
        'code'=> 200,
      ]);
    }
}
