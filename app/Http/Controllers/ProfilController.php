<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Jcf\Geocode\Geocode;
use App\User;
use JWTAuth;



class ProfilController extends Controller
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

  public function geocode($city, $address, $province)
  {

    $response = Geocode::make()->address($address.",".$city.",". $province);
    if ($response == false) {
      $response = Geocode::make()->address($address.",".$city);
      if ($response == false) {
        $response = Geocode::make()->address($city);
      }
    }

    if ($response)
      {
        return $data = array(
          'lat' => $response->latitude(),
          'lng' => $response->longitude(),
          'address_format' => $response->formattedAddress(),
        );
      }else {
        return $data = array(
          'lat' => null,
          'lng' => null,
          'address_format' => null,
        );
      }


  }

    public function index()
    {
      $user = auth()->user()->profiles;

      return response()->json([
        'user_profile' =>$user,
        'code'=> 200,
      ]);
    }

    public function create()
    {
      # code...
    }

    public function update(Request $request)
    {
      $user = auth()->user()->profiles;
      $user->full_name = $request->json('full_name');
      $user->address = $request->json('address');
      $user->city = $request->json('city');

      $geo = $this->geocode($request->json('city'), $request->json('address'), "");
      $user->lat = $geo['lat'];
      $user->lng = $geo['lng'];
      $user->address_format= $geo['address_format'];

      $user->phone = $request->json('phone');
      $user->gender = $request->json('gender');
      $user->photo_profile_link = $request->json('photo_profile_link');
      $user->ktp_link = $request->json('ktp_link');
      $user->blood = $request->json('blood');
      $user->born_date = $request->json('born_date');
      $user->born_city = $request->json('born_city');
      $geo_born = $this->geocode($request->json('born_city'), "", "");

      $user->born_lat = $geo['lat'];
      $user->born_lng = $geo['lng'];
      
      $user->marriage_status = $request->json('marriage_status');
      $user->facebook = $request->json('facebook');
      $user->instagram = $request->json('instagram');
      $user->blog = $request->json('blog');
      $user->line = $request->json('line');
      $user->disease_history = $request->json('disease_history');
      $user->video_profile = $request->json('video_profile');
      $user->religion = $request->json('religion');
      $user->is_ready = $request->json('is_ready');
      $user->update();

      return response()->json([
        'user_profile' =>$user,
        'message'=>'Success ! Profile Updated',
        'code'=> 200,
      ]);
    }

    public function delete()
    {
      # code...
    }
}
