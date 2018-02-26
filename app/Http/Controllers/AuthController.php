<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Bogardo\Mailgun\Mail\Message;
use App\Mail\activateAccount;
use Illuminate\Http\Request;
use App\models\institution;
use App\models\profile;
use App\User;
use JWTAuth;
use Mailgun;


class AuthController extends Controller
{
    //

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','signup','activate','resend','institution','deletebagus']]);
    }

    public function institution()
    {
      $institution = institution::orderBy('institution_name','asc')->distinct()->pluck('institution_name');
      return response()->json([
        'institutions' =>$institution
      ]);
    }


    public function signup(Request $request)
    {

      $this->validate($request, [
        'email'=> 'required|unique:users',
        'password'=>'required',
      ]);

      $dbuseradd = new user;
      $dbuseradd->email = $request->json('email');
      $dbuseradd->keyword = $request->json('password');
      $dbuseradd->password = bcrypt($request->json('password'));
      $dbuseradd->name = $request->json('name');

      if ($request->json('regional_id') !== null) {
        $dbuseradd->regional_id = $request->json('regional_id');
      }

      $dbuseradd->member_or_not = 0;
      $dbuseradd->unique_code = rand(100000,999999);
      $dbuseradd->save();

      /**
       * Generate Tabel Profile
       */

      $profile = new profile;
      $profile->user_id = $dbuseradd->id;
      $profile->full_name = $dbuseradd->name;
      $profile->is_ready = 0;
      $profile->save();

      $email_data = array('user' =>$dbuseradd , );

      $theemail = $request->json('email');

      Mailgun::send('email.verificationUser', $email_data, function ($message) use ($theemail) {
          $message->to($theemail)->subject('Selamat datang Pemuda/i Indoneisa di Portal Forum Indonesia Muda');
      });

      // $mail = Mail::to($request->json('email'))->send(new activateAccount($dbuseradd));

      return response()->json([
        'message' =>'Successfully Create an Account'
      ]);

    }

    /**
     * Aktivasi
     */
     public function activate(Request $request)
     {
       # code...
       $this->validate($request, [
         'email'=> 'required',
         'unique_code'=>'required',
       ]);

       $account = User::where('email', $request->json('email'))->first();

       if ($account->active == 1) {
         return response()->json([
           'message' =>'Account Already Activated',
           'account_status'=> $account->active,
           'account'=>$account,
           'code' => 200,
         ]);
       }elseif ($account->active == 0 && $account->unique_code == $request->json('unique_code')) {
         $account->active = 1 ;
         $account->save();
         return response()->json([
           'message' =>'Successfully Activated',
           'account_status'=>$account->active,
           'account'=>$account,
           'code' => 200,
         ]);

       }else {
         return response()->json([
           'message' =>'Code or email not Valid, Failed to Activate',
           'account_status'=> 0,
         ]);
       }
     }

     /**
      * Resend Email Verification
      */

      public function resend(Request $request)
      {
        $email=$request-json('email');
        $dbuseradd = User::where('email', $email)->first();
        $dbuseradd->unique_code = rand(100000,999999);
        $dbuseradd->save();

        $mail = Mail::to($request->json('email'))->send(new activateAccount($dbuseradd));

        return response()->json([
          'message' =>'Successfully Processing Resend Verification Email',
          'code' => 200,
        ]);
      }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {

        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
          'token' => $this->respondWithToken($token),
          'user' =>auth()->user(),
          'account_status'=>auth()->user()->active,
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {

        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 6000000
        ]);
    }

    public function change_password(Request $request)
    {
      $account = auth()->user();

      $old_password = $request->json('old_password');
      $new_password = $request->json('new_password');
      $new1_password = $request->json('new1_password');

      if ($new_password !== $new1_password) {
        return response()->json([
            'message' => "Your New Password Didn't Match",
            'code' => 304,
        ]);
      }

      if ($account->bcrypt($request->json('old_password')) && bcrypt($request->json('password'))) {
        $account->password = bcrypt($request->json('new_password'));
        $account->save();

        return response()->json([
            'message' => "Password has been changed",
            'code' => 200,
        ]);
      }else {
        return response()->json([
            'message' => "Please Try Again",
            'code' => 401,
        ]);
      }

    }

    public function deletebagus()
    {
      $user = user::where('email','dwiutamabagus@gmail.com')->first();
      $user->profiles()->delete();
      $user->delete();

      dd("berhasil");
    }
}
