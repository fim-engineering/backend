<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\models\regional;
use App\User;
use Excel;

class seleksiController extends Controller
{
    //

    public function selectregional()
    {
      $regional = regional::OrderBy('regional_name','asc')->get();

      $data = array('regionals' =>$regional , );

      return view('select-regional')->with($data);
    }

    public function view_list_member(Request $request)
    {

        $regional = $request->regional;

        $all_submit = DB::table('users')
             ->join('profiles', function ($join) use ($regional) {
                 $join->on('users.id', '=', 'profiles.user_id')
                      ->where([['profiles.city', $regional],['users.final_submit', 1]])->whereNull('users.deleted_at');
             })
             ->get();

               $data = array(
                 'members' => $all_submit,
                 'regional' => $regional,
               );
             return view('list-peserta')->with($data);
    }

    public function delete_member()
    {
      $email = $_GET['email'];
      $email = urldecode($email);

      $member = User::where('email', $email)->first();

      $member->delete();

      return Response::json([
        'status' => 'deleted',
        'message' => "berhasil delete",
      ], 200);
    }

    public function view_peserta()
    {
      $email = $_GET['email'];
      $email = urldecode($email);

      $user = User::where('email', $email)->first();

      $profiles = $user->profiles;
      $personality = $user->personality;
      $achievement_bests = $user->achievement_bests;
      $me_and_fim = $user->me_and_fim;

      $data = array(
        'user' => $user ,
        'profile' => $profiles ,
        'personality' => $personality ,
        'achievement' => $achievement_bests ,
        'meandfim' => $me_and_fim ,
      );

      return response()->json($data);
      // dd($data);
    }

    public function download_excel(Request $request)
    {
      $regional = $request->regional;


      return Excel::download(new \App\Exports\invoicesExport($regional), 'invoices.xlsx');

    }
}
