<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\User;

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
         ->paginate(20);


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
         ->paginate(20);

         return response()->json([
           'user_data' => $all_submit,
           'code' => 200,
         ]);

    }

    public function all_submit_yet(Request $request)
    {
      $all_submit = DB::table('users')
         ->join('profiles', 'users.id', '=', 'profiles.user_id')
         // ->join('achievement_bests', 'users.id', '=', 'achievement_bests.user_id')
         // ->join('me_and_fims', 'users.id', '=', 'me_and_fims.user_id')
         // ->join('personalities', 'users.id', '=', 'personalities.user_id')
         ->where('users.final_submit', 0)->get();
         // ->paginate(20);

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
        ->paginate(20);
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
        ->paginate(20);
      }else {
        $regional_all ="need regional json value";
      }

         return response()->json([
           'user_data' => $regional_all,
           'code' => 200,
         ]);
    }

    public function by_regional_submit_yet(Request $request)
    {

      if ($request->json('regional')) {
        $regional_all = DB::table('users')
        ->join('profiles', 'users.id', '=', 'profiles.user_id')
        // ->join('achievement_bests', 'users.id', '=', 'achievement_bests.user_id')
        // ->join('me_and_fims', 'users.id', '=', 'me_and_fims.user_id')
        // ->join('personalities', 'users.id', '=', 'personalities.user_id')
        ->where([['profiles.city', $request->json('regional')],['users.final_submit', 0]])
        ->get();
      }else {
        $regional_all ="need regional json value";
      }

         return response()->json([
           'user_data' => $regional_all,
           'code' => 200,
         ]);
    }

    // cari orang yang belum ngisi regional
    public function get_person_who_not_fill_regional()
    {
      $all_submit = DB::table('users')
         ->join('profiles', 'users.id', '=', 'profiles.user_id')
         ->join('achievement_bests', 'users.id', '=', 'achievement_bests.user_id')
         ->join('me_and_fims', 'users.id', '=', 'me_and_fims.user_id')
         ->join('personalities', 'users.id', '=', 'personalities.user_id')
         ->where([['profiles.city', NULL],['users.final_submit', 1]])->get();
         // ->paginate(20);

         foreach ($all_submit as $key => $value) {
           $usersd = User::find($value->id);
           $usersd->final_submit = 0;
           $usersd->save();
         }

         return response()->json([
           'user_data' => $all_submit,
           'code' => 200,
         ]);
    }
}
