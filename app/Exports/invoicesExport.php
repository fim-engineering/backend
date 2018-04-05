<?php

namespace App\Http\Controllers;
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Excel;
use App\User;
use App\models\profile;



class InvoicesExport implements FromCollection
{

    // use Exportable;
    public $regional;

    public function __construct($regional)
    {
        $this->regional = $regional;

    }

    public function collection()
    {

      $members =  DB::table('users')
        ->join('achievement_bests', 'users.id', '=', 'achievement_bests.user_id')
        ->join('me_and_fims', 'users.id', '=', 'me_and_fims.user_id')
        ->join('personalities', 'users.id', '=', 'personalities.user_id')
        ->join('profiles', function ($join) {
               $join->on('users.id', '=', 'profiles.user_id')
                    ->where([['profiles.city', $this->regional],['users.final_submit', 1]])->whereNull('users.deleted_at');
           })
           ->get();

           return $members;
    }

}
