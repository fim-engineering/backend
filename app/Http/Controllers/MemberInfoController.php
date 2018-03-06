<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class MemberInfoController extends Controller
{
    //

    public function all(Request $request)
    {

      $all_user = DB::table('users')
         ->join('profiles', 'users.id', '=', 'profiles.user_id')
         ->join('achievement_bests', 'users.id', '=', 'achievement_bests.user_id')
         ->join('me_and_fims', 'users.id', '=', 'me_and_fims.user_id')
         ->join('personalities', 'users.id', '=', 'personalities.user_id')
         ->get();


      return response()->json([
        'user_data' => $all_user,
        'code' => 200,
      ]);
    }

    public function all_submit(Request $request)
    {
      $all_submit = DB::table('users')
         ->join('profiles', 'users.id', '=', 'profiles.user_id')
         ->join('achievement_bests', 'users.id', '=', 'achievement_bests.user_id')
         ->join('me_and_fims', 'users.id', '=', 'me_and_fims.user_id')
         ->join('personalities', 'users.id', '=', 'personalities.user_id')
         ->where('users.final_submit', 1)
         ->get();

         return response()->json([
           'user_data' => $all_submit,
           'code' => 200,
         ]);

    }

    public function by_regional_all(Request $request)
    {

      if ($request->json('regional')) {
         $regional_all = DB::table('users')
        ->join('profiles', 'users.id', '=', 'profiles.user_id')
        ->join('achievement_bests', 'users.id', '=', 'achievement_bests.user_id')
        ->join('me_and_fims', 'users.id', '=', 'me_and_fims.user_id')
        ->join('personalities', 'users.id', '=', 'personalities.user_id')
        ->where('profiles.city', $request->json('regional'))
        ->get();
      }else {
        $regional_all = "need regional json value";
      }

      return response()->json([
        'user_data' => $regional_all,
        'code' => 200,
      ]);
    }


    public function by_regional_submit(Request $request)
    {

      if ($request->json('regional')) {
        $regional_all = DB::table('users')
        ->join('profiles', 'users.id', '=', 'profiles.user_id')
        ->join('achievement_bests', 'users.id', '=', 'achievement_bests.user_id')
        ->join('me_and_fims', 'users.id', '=', 'me_and_fims.user_id')
        ->join('personalities', 'users.id', '=', 'personalities.user_id')
        ->where([['profiles.city', $request->json('regional')],['users.final_submit', 1]])
        ->get();
      }else {
        $regional_all ="need regional json value";
      }

         return response()->json([
           'user_data' => $regional_all,
           'code' => 200,
         ]);
    }
}
