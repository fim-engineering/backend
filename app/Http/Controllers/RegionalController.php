<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Jcf\Geocode\Geocode;
use App\models\regional;
use App\User;
use JWTAuth;





class RegionalController extends Controller
{

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
      $regional= regional::OrderBy('regional_name','asc')->get();

      return response()->json([
        'regionals' =>$regional,
        'code' => 200,
      ]);

    }

    public function create(Request $request)
    {
       $regional_name = $request->json('regional_name');
       $logo          = $request->json('logo');
       $id_google_calendar = $request->json('id_google_calendar');
       $address       = $request->json('address');
       $city          = $request->json('city');

       $geo_address   = $this->geocode($request->json('city'), $request->json('address'), "");

       $lat = $geo_address['lat'];
       $lng = $geo_address['lng'];
       $address_format = $geo_address['address_format'];

       $leader_member_id  = $request->json('user_id');
       $user_submit       = auth()->user()->name;

       $reg = new regional;
       $reg->regional_name  = $regional_name;
       $reg->logo           = $logo;
       $reg->id_google_calendar = $id_google_calendar;
       $reg->address        = $adress;
       $reg->lat            = $lat;
       $reg->lng            = $lng;
       $reg->address_format = $address_format;
       $reg->leader_member_id = $leader_member_id;
       $reg->user_submit      = $user_submit;
       $reg->save();

       return response()->json([
         'message' => "Success",
         'regionals' =>$reg,
         'code' => 200,
       ]);

    }


    public function edit(Request $request)
    {
      $id = $request->json('regional_id');
      $regional= regional::find($id);

      return response()->json([
        'regionals' =>$regional,
        'code' => 200,
      ]);
    }

    public function update(Request $request,$id)
    {
      $regional_name = $request->json('regional_name');
      $logo          = $request->json('logo');
      $id_google_calendar = $request->json('id_google_calendar');
      $address       = $request->json('address');
      $city          = $request->json('city');

      $geo_address   = $this->geocode($request->json('city'), $request->json('address'), "");

      $lat = $geo_address['lat'];
      $lng = $geo_address['lng'];
      $address_format = $geo_address['address_format'];

      $leader_member_id  = $request->json('user_id');
      $user_submit       = auth()->user()->name;

      $reg = regional::find($id);
      $reg->regional_name  = $regional_name;
      $reg->logo           = $logo;
      $reg->id_google_calendar = $id_google_calendar;
      $reg->address        = $adress;
      $reg->lat            = $lat;
      $reg->lng            = $lng;
      $reg->address_format = $address_format;
      $reg->leader_member_id = $leader_member_id;
      $reg->user_update      = $user_submit;
      $reg->save();

      return response()->json([
        'message' => "Updated",
        'regionals' =>$reg,
        'code' => 200,
      ]);
    }

    public function delete(Request $request)
    {
      $id = $request->json('id_regional');
      $del = regional::find($id)->delete();

      return response()->json([
        'message' => "Deleted",
        'code' => 200,
      ]);
    }


}
