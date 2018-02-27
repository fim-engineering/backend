<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\achievement_best;
use App\User;
use JWTAuth;
use Carbon\Carbon;
use App\models\position;


class AchievementBestController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth:api');
  }

  public function index()
  {
    $achievement_best = auth()->user()->achievement_bests;
    if ($achievement_best !== NULL) {
      $achievement_best = auth()->user()->achieachievement_bests;
      $code = 200;
    }else {
      $achievement_best = "Null Data, Try to Update First";
      $code = 401;
    }

    return response()->json([
      'achie_best' =>$achievement_best,
      'code'=> $code,
    ]);
  }

  public function update(Request $request)
  {
     $id = auth()->user()->achievement_bests;

     if ($id !== null ) {
       $a = achievement_best::find($id->id);
     }else {
       $a = new achievement_best;
     }

     /**
      * Achievement 1
      */

      $a->user_id     = auth()->user()->id;

      if ($request->json('achievement')) {
        $a->achievement = $request->json('achievement');
      }

      if ($request->json('date_from')) {
        $a->date_from   = $request->json('date_from');
      }

      if ($request->json('date_end') && $request->json('date_from')) {
        $a->date_end    = $request->json('date_end');
        $from = Carbon::createFromFormat('Y-m-d', $request->json('date_from'));
        $end = Carbon::createFromFormat('Y-m-d', $request->json('date_end'));
        $duration = $from->diffInDays($end);
        $a->duration    = $duration/350;
      }

      if ($request->json('position_name')){
        $a->position    = $request->json('position_name');

        $pos = position::where('position_name', $request->json('position_name'))->first();
        if ($pos !== NULL) {
          $a->position_id = $pos->id;
        }
        // else {
        //   $p = new position;
        //   $p->position_name = $request->json('position_name');
        //   $p->save();
        //
        //   $a->position_id   = $p->id;
        // }
      }

      if ($request->json('phone_leader')) {
        $a->phone_leader = $request->json('phone_leader');
      }

      if ($request->json('email_leader')) {
        $a->email_leader = $request->json('email_leader');
      }

      if ($request->json('description')) {
        $a->description = $request->json('description');
      }

      /**
       * Achievement 2
       */

       if ($request->json('achievement_2')) {
         $a->achievement_2 = $request->json('achievement_2');
       }

       if ($request->json('date_from_2')) {
         $a->date_from_2   = $request->json('date_from_2');
       }

       if ($request->json('date_end_2') && $request->json('date_from_2')) {
         $a->date_end_2    = $request->json('date_end_2');
         $from_2 = Carbon::createFromFormat('Y-m-d', $request->json('date_from_2'));
         $end_2 = Carbon::createFromFormat('Y-m-d', $request->json('date_end_2'));
         $duration_2 = $from_2->diffInDays($end_2);
         $a->duration_2    = $duration_2/350;
       }

       if ($request->json('position_name_2')){
         $a->position_2    = $request->json('position_name_2');

         $pos_2 = position::where('position_name', $request->json('position_name_2'))->first();
         if ($pos_2 !== NULL) {
           $a->position_id_2 = $pos_2->id;
         }
         // else {
         //   $q = new position;
         //   $q->position_name = $request->json('position_name_2');
         //   $q->save();
         //
         //   $a->position_id_2   = $q->id;
         // }
       }

       if ($request->json('phone_leader_2')) {
         $a->phone_leader_2 = $request->json('phone_leader_2');
       }

       if ($request->json('email_leader_2')) {
         $a->email_leader_2 = $request->json('email_leader_2');
       }

       if ($request->json('description')) {
         $a->description_2 = $request->json('description');
       }

       /**
        * Achievement 3
        */

        if ($request->json('achievement_3')) {
          $a->achievement_3 = $request->json('achievement_3');
        }

        if ($request->json('date_from_3')) {
          $a->date_from_3   = $request->json('date_from_3');
        }

        if ($request->json('date_end_3') && $request->json('date_from_3')) {
          $a->date_end_3    = $request->json('date_end_3');
          $from_3 = Carbon::createFromFormat('Y-m-d', $request->json('date_from_3'));
          $end_3 = Carbon::createFromFormat('Y-m-d', $request->json('date_end_3'));
          $duration_3 = $from_3->diffInDays($end_3);
          $a->duration_3    = $duration_3/350;
        }

        if ($request->json('position_name_3')){
          $a->position_3    = $request->json('position_name_3');

          $pos_3 = position::where('position_name', $request->json('position_name_3'))->first();
          if ($pos_3 !== NULL) {
            $a->position_id_3 = $pos_3->id;
          }
          // else {
          //   $q = new position;
          //   $q->position_name = $request->json('position_name_3');
          //   $q->save();
          //
          //   $a->position_id_3   = $q->id;
          // }
        }

        if ($request->json('phone_leader_3')) {
          $a->phone_leader_3 = $request->json('phone_leader_3');
        }

        if ($request->json('email_leader_3')) {
          $a->email_leader_3 = $request->json('email_leader_3');
        }

        if ($request->json('description')) {
          $a->description_3 = $request->json('description');
        }

     $a->save();

     return response()->json([
       'personality' =>$a,
       'message'=>'Success ! The Personality Updated',
       'code'=> 200,
     ]);


  }
}
