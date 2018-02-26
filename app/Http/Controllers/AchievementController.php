<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\achievement;
use App\models\position;
use Illuminate\Support\Facades\Auth;
use App\User;
use JWTAuth;



class AchievementController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
      $achievement = auth()->user()->achievements;

      return response()->json([
        'achievement' =>$achievement,
        'code'=> 200,
      ]);
    }

    public function create(Request $request)
    {
      $a = new achievement;
      $a->user_id     = auth()->user()->id;

      if ($request->json('achievement')) {
        $a->achievement = $request->json('achievement');
      }

      if ($request->json('date_from')) {
        $a->date_form   = $request->json('date_from');
      }

      if ($request->json('date_end') && $request->json('date_from')) {
        $a->date_end    = $request->json('date_end');
        $from = Carbon::createFromFormat('Y-m-d', $request->json('date_from'));
        $end = Carbon::createFromFormat('Y-m-d', $request->json('date_from'));
        $duration = $from->diffInDays($end);
        $a->duration    = $duration/350;
      }

      if ($request->json('position_name')){
        $a->position    = $request->json('position_name');

        $pos = position::where('position_name', $request->json('position_name'))->first();
        if ($pos) {
          $a->position_id = $pos->id;
        }else {
          $p = new position;
          $p->position_name = $request->json('position_name');
          $p->save();

          $a->position_id   = $p->id;
        }
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

      if ($request->json('is_ready')) {
        $a->is_ready = $request->json('is_ready');
      }

      $a->save();

      return response()->json([
        'user_achievements' =>$a,
        'message'=>'Success ! Achievements Added',
        'code'=> 200,
      ]);
    }

    /**
     * /achievement/{id}/edit','AchievementController@edit
     */

     public function edit($id)
     {
       $e = achievement::find($id);

       return response()->json([
         'user_achievements' =>$id,
         'code'=> 200,
       ]);
     }

     public function update(Request $request, $id)
     {
       $a = achievement::find($id);

       if ($request->json('achievement')) {
         $a->achievement = $request->json('achievement');
       }

       if ($request->json('date_from')) {
         $a->date_form   = $request->json('date_from');
       }

       if ($request->json('date_end') && $request->json('date_from')) {
         $a->date_end    = $request->json('date_end');
         $from = Carbon::createFromFormat('Y-m-d', $request->json('date_from'));
         $end = Carbon::createFromFormat('Y-m-d', $request->json('date_from'));
         $duration = $from->diffInDays($end);
         $a->duration    = $duration/350;
       }

       if ($request->json('position_name')){
         $a->position    = $request->json('position_name');

         $pos = position::where('position_name', $request->json('position_name'))->first();
         if ($pos) {
           $a->position_id = $pos->id;
         }else {
           $p = new position;
           $p->position_name = $request->json('position_name');
           $p->save();

           $a->position_id   = $p->id;
         }
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

       if ($request->json('is_ready')) {
         $a->is_ready = $request->json('is_ready');
       }

       $a->update();

       return response()->json([
         'user_achievements' =>$a,
         'message'=>'Success ! The Achievement Updated',
         'code'=> 200,
       ]);
     }

     public function delete(Request $request, $id)
     {
       $a = achievement::find($id)->delete();
       return response()->json([
         'message'=>'Achievement Deleted',
         'code'=> 200,
       ]);
     }




}
