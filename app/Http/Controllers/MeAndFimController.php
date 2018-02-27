<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\me_and_fim;
use App\models\fim_info_reference;

class MeAndFimController extends Controller
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
      $meandfim = auth()->user()->me_and_fim;
      if ($meandfim !== null) {
        $meandfim = auth()->user()->me_and_fim;
        $code = 200;
      }else {
        $meandfim = "Null Data, Try to Update First";
        $code = 401;
      }

      return response()->json([
        'meandfim' =>$meandfim,
        'code'=> $code,
      ]);
    }

    public function update(Request $request)
    {
      $meandfim = auth()->user()->me_and_fim;

      if ($meandfim !== null ) {
        $meandfim = personality::find($meandfim->id);
      }else {
        $meandfim = new personality;
      }

      $meandfim->user_id  = auth()->user()->id;
      if ( $request->json('fim_reference')) {
        $meandfim->fim_reference  = $request->json('fim_reference');

        $reference = fim_info_reference::where('references', $request->json('fim_reference'))->first();
        if ($reference) {
          $meandfim->fim_reference_id = $reference->id;
        }
      }

      if ($request->json('why_join_fim')) {
        $meandfim->why_join_fim = $request->json('why_join_fim');
      }
      if ( $request->json('skill_for_fim')) {
        $meandfim->skill_for_fim  = $request->json('skill_for_fim');
      }
      
      if ( $request->json('performance_apiekspresi')) {
        $meandfim->performance_apiekspresi  = $request->json('performance_apiekspresi');
      }
      if ($request->json('is_ready')) {
        $meandfim->is_ready = $request->json('is_ready');
      }

        $meandfim->save();
        return response()->json([
          'meandfim' =>$meandfim,
          'message'=>'Success ! The me-and-fim data Updated',
          'code'=> 200,
        ]);
    }
}
