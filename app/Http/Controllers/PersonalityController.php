<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\personality;
use Illuminate\Support\Facades\Auth;
use App\models\mbti;
use App\User;
use JWTAuth;
use App\models\best_performance;


class PersonalityController extends Controller
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
    $personality = auth()->user()->personality;
    if ($personality !== null) {
      $personality = auth()->user()->personality;
      $code = 200;
    }else {
      $personality = "Null Data, Try to Update First";
      $code = 401;
    }

    return response()->json([
      'personality' =>$personality,
      'code'=> $code,
    ]);
  }

  public function update(Request $request)
  {
     $personality = auth()->user()->personality;

     if ($personality !== null ) {
       $person = personality::find($personality->id);
     }else {
       $person = new personality;
     }

     $person->user_id  = auth()->user()->id;

     if($request->json('mbti')) {
       $person->mbti = $request->json('mbti');

       $mbti = mbti::where('mbti_type', $request->json('mbti'))->first();
       if ($mbti !== null) {
         $person->mbti_id= $mbti->id;
       }
     }

     if($request->json('best_performance')) {
       $person->best_performance = $request->json('best_performance');

       $best = best_performance::where('type', $request->json('best_performance'))->first();
       if ($best !== null) {
         $person->best_performance_id = $best->id;
       }
     }

     if($request->json('strength')) {
       $person->strength = $request->json('strength');
     }
     if($request->json('weakness')) {
       $person->weakness = $request->json('weakness');
     }
     if($request->json('role_model')) {
       $person->role_model = $request->json('role_model');
     }
     if($request->json('problem_solver')) {
       $person->problem_solver = $request->json('problem_solver');
     }
     if($request->json('cintakasih')) {
       $person->cintakasih = $request->json('cintakasih');
     }
     if($request->json('integritas')) {
       $person->integritas = $request->json('integritas');
     }
     if($request->json('kebersahajaan')) {
       $person->kebersahajaan  = $request->json('kebersahajaan');
     }
     if($request->json('totalitas')) {
       $person->totalitas  = $request->json('totalitas');
     }
     if($request->json('solidaritas')) {
       $person->solidaritas  = $request->json('solidaritas');
     }
     if($request->json('keadilan')) {
       $person->keadilan = $request->json('keadilan');
     }
     if($request->json('keteladanan')) {
       $person->keteladanan  = $request->json('keteladanan');
     }
     if($request->json('is_ready')) {
       $person->is_ready  = $request->json('is_ready');
     }

     $person->save();

     return response()->json([
       'personality' =>$person,
       'message'=>'Success ! The Personality Updated',
       'code'=> 200,
     ]);


  }

}
