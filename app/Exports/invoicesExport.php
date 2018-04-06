<?php

namespace App\Http\Controllers;
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Illuminate\Support\Facades\DB;
use Excel;
use App\User;
use App\models\profile;



class InvoicesExport implements FromCollection, WithHeadings
{

    // use Exportable;
    public $regional;

    public function __construct($regional)
    {
        $this->regional = $regional;

    }

    public function collection()
    {

      // $members =  DB::table('users')
      //   ->join('achievement_bests', 'users.id', '=', 'achievement_bests.user_id')
      //   ->join('me_and_fims', 'users.id', '=', 'me_and_fims.user_id')
      //   ->join('personalities', 'users.id', '=', 'personalities.user_id')
      //   ->join('profiles', function ($join) {
      //          $join->on('users.id', '=', 'profiles.user_id')
      //               ->where([['profiles.city', $this->regional],['users.final_submit', 1]])->whereNull('users.deleted_at');
      //      })
      //      ->get();
      //      $members= json_decode( json_encode($members), true);

      $members =  User::join('achievement_bests', 'users.id', '=', 'achievement_bests.user_id')
        ->join('me_and_fims', 'users.id', '=', 'me_and_fims.user_id')
        ->join('personalities', 'users.id', '=', 'personalities.user_id')
        ->join('profiles', function ($join) {
               $join->on('users.id', '=', 'profiles.user_id')
                    ->where([['profiles.city', $this->regional],['users.final_submit', 1]])->whereNull('users.deleted_at');
           })
           ->select(
             'name',
             'email',
             'users.created_at',
             'final_submit',
             'generation',
             'majors',
             'institution',
             'address',
             'city',
             'phone',
             'gender',
             'photo_profile_link',
             'ktp_link',
             'blood',
             'born_date',
             'born_city',
             'marriage_status',
             'facebook',
             'instagram',
             'blog',
             'line',
             'disease_history',
             'video_profile',
             'religion',

             'achievement',
             'position_name',
             'date_from',
             'date_end',
             'duration',
             'phone_leader',
             'email_leader',
             'description',
             'achievement_2',
             'position_name_2',
             'date_from_2',
             'date_end_2',
             'duration_2',
             'phone_leader_2',
             'email_leader_2',
             'description_2',
             'achievement_3',
             'position_name_3',
             'date_from_3',
             'date_end_3',
             'duration_3',
             'phone_leader_3',
             'email_leader_3',
             'description_3',

             'mbti',
             'best_performance',
             'strength',
             'weakness',
             'role_model',
             'role_model_2',
             'role_model_3',


             'problem_solver',
             'problem_solver_2',
             'problem_solver_3',

             'why_join_fim',
             'performance_apiekspresi',
             'skill_for_fim'


           );

           return $members;
    }

    public function headings(): array
    {
        return [
          'name',
          'email',
          'users.created_at',
          'final_submit',
          'generation',
          'majors',
          'institution',
          'address',
          'city',
          'phone',
          'gender',
          'photo_profile_link',
          'ktp_link',
          'blood',
          'born_date',
          'born_city',
          'marriage_status',
          'facebook',
          'instagram',
          'blog',
          'line',
          'disease_history',
          'video_profile',
          'religion',

          'achievement',
          'position_name',
          'date_from',
          'date_end',
          'duration',
          'phone_leader',
          'email_leader',
          'description',
          'achievement_2',
          'position_name_2',
          'date_from_2',
          'date_end_2',
          'duration_2',
          'phone_leader_2',
          'email_leader_2',
          'description_2',
          'achievement_3',
          'position_name_3',
          'date_from_3',
          'date_end_3',
          'duration_3',
          'phone_leader_3',
          'email_leader_3',
          'description_3',

          'mbti',
          'best_performance',
          'strength',
          'weakness',
          'role_model',
          'role_model_2',
          'role_model_3',


          'problem_solver',
          'problem_solver_2',
          'problem_solver_3',

          'why_join_fim',
          'performance_apiekspresi',
          'skill_for_fim'
        ];
    }

}
