<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;
use App\models\regional;

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
                      ->where([['profiles.city', $regional],['users.final_submit', 1]]);
             })
             ->paginate(20);

               $data = array('members' => $all_submit,);
             return view('list-peserta')->with($data);
    }
}
