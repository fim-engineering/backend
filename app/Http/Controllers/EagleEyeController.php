<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Bogardo\Mailgun\Mail\Message;
use App\models\achievement_best;
use Illuminate\Http\Request;
use App\models\personality;
use App\models\me_and_fim;
use App\models\profile;
use App\User;
use Mailgun;
use JWTAuth;



class EagleEyeController extends Controller
{
    public function status()
    {
      $user = auth()->user();

      $profile      = $user->profiles;
      if ($profile     !== null) {
        $profile      = $user->profiles->is_ready;
      }else {
        $profile      = "xxx";
      }
      $achievement  = $user->achievement_bests;
      if ($achievement !== null) {
        $achievement  = $user->achievement_bests->is_ready;
      }else {
        $achievement  = "xxx";
      }
      $personality  = $user->personality;
      if ($personality !== null) {
        $personality  = $user->personality->is_ready;
      }else {
        $personality  = "xxx";
      }
      $meandfim     = $user->me_and_fim;
      if ($meandfim    !== null) {
        $meandfim     = $user->me_and_fim->is_ready;
      }else {
        $meandfim     = "xxx";
      }
      $final        = $user->final_submit;

      return response()->json([
        'status_profile' =>$profile,
        'status_achievement' =>$achievement,
        'status_personality' =>$personality,
        'status_meandfim' =>$meandfim,
        'final' =>$final,
      ]);

    }

    public function confirm(Request $request)
    {
      $user = auth()->user();

      $profile      = $user->profiles;
      if ($profile     !== null) {
        $profile      = 1;
      }
      $achievement  = $user->achievement_bests;
      if ($achievement !== null) {
        $achievement  = 1;
      }
      $personality  = $user->personality;
      if ($personality !== null) {
        $personality  = 1;
      }
      $meandfim     = $user->me_and_fim;
      if ($meandfim    !== null) {
        $meandfim     = 1;
      }


      $user->final_submit = 1;
      $user->update();

      $email_data = array('user' =>$user , );

      $theemail = $user->email;

      Mailgun::send('email.final-submission-user', $email_data, function ($message) use ($theemail) {
          $message->to($theemail)->subject('Terima Kasih Telah Mendaftarkan diri menjadi kader Next Gen FIM 20');
      });


      return response()->json([
        'message'=>'Data Updated',
        'code'=> 200,
      ]);
    }


    public function revert_confirm(Request $request)
    {
      $user = auth()->user();

      $profile      = $user->profiles;
      if ($profile     !== null) {
        $profile      = 0;
      }
      $achievement  = $user->achievement_bests;
      if ($achievement !== null) {
        $achievement  = 0;
      }
      $personality  = $user->personality;
      if ($personality !== null) {
        $personality  = 0;
      }
      $meandfim     = $user->me_and_fim;
      if ($meandfim    !== null) {
        $meandfim     = 0;
      }

      $user->final_submit = 0;
      $user->update();

      return response()->json([
        'message'=>'Data Reverted',
        'code'=> 200,
      ]);
    }
}
