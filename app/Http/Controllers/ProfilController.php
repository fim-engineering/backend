<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Jcf\Geocode\Geocode;
use App\models\institution;
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

      if ($request->json('full_name') !== NULL) {
        $user->full_name = $request->json('full_name');
      }

      if ($request->json('regional_id') !== null) {
        $aut = auth()->user();
        $aut->regional_id = $request->json('regional_id');
      }

      if ($request->json('institution') !== NULL) {
        $user->institution = $request->json('institution');

        $institution = institution::where('institution_name','like', '%'.$request->json('institution').'%')->first();
        if ($institution !== null) {
          $id_kampus = $institution->id;
          $user->institution_id = $id_kampus;
        }else {
          $institutionadd = new institution;
          $institutionadd->institution_name = $request->json('institution');
          $institutionadd->save();
          $user->institution_id = $institutionadd->id;
        }
      }

      if ($request->json('generation') !== NULL) {
        $user->generation = $request->json('generation');
      }


      if ($request->json('majors') !== NULL) {
        $user->majors = $request->json('majors');
      }

      if ($request->json('address') !== NULL) {
        $user->address = $request->json('address');
      }

      if ($request->json('city') !== NULL) {
        $user->city = $request->json('city');
      }

      if ($request->json('city') !== NULL && $request->json('address') !== NULL) {
        $geo = $this->geocode($request->json('city'), $request->json('address'), "");
        if ($geo) {
          $user->lat = $geo['lat'];
          $user->lng = $geo['lng'];
          $user->address_format= $geo['address_format'];
        }
      }

      if ($request->json('phone') !== NULL) {
        $user->phone = $request->json('phone');
      }

      if ($request->json('gender') !== NULL) {
        $user->gender = $request->json('gender');
      }

      if ($request->json('photo_profile_link') !== NULL) {
        $user->photo_profile_link = $request->json('photo_profile_link');
      }

      if ($request->json('ktp_link') !== NULL) {
        $user->ktp_link = $request->json('ktp_link');
      }

      if ($request->json('blood')) {
        $user->blood = $request->json('blood');
      }

      if ($request->json('born_date') !== null) {
        $user->born_date = $request->json('born_date');
      }

      if ($request->json('born_city')) {
        $user->born_city = $request->json('born_city');
      }

      if ($request->json('born_city') !== NULL && $request->json('born_address') !== NULL) {

        $geo_born = $this->geocode($request->json('born_city'), "", "");
        $user->born_lat = $geo_born['lat'];
        $user->born_lng = $geo_born['lng'];
      }

      if ($request->json('marriage_status') !==null) {
        $user->marriage_status = $request->json('marriage_status');
      }

      if ($request->json('facebook')) {
        $user->facebook = $request->json('facebook');
      }

      if ($request->json('instagram')) {
        $user->instagram = $request->json('instagram');
      }

      if ($request->json('blog')) {
        $user->blog = $request->json('blog');
      }

      if ($request->json('line')) {
        $user->line = $request->json('line');
      }

      if ($request->json('disease_history') !==null) {
        $user->disease_history = $request->json('disease_history');
      }

      if ($request->json('video_profile') !== null) {
        $user->video_profile = $request->json('video_profile');
      }

      if ($request->json('religion') !== null) {
        $user->religion = $request->json('religion');
      }

      if ($request->json('is_ready') !== null) {
        $user->is_ready = $request->json('is_ready');
      }

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
