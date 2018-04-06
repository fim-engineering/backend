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
           ->get();

           return $members;
    }

    public function headings(): array
    {
        return [
      "id",// 17
      "name",// "Bagus Dwi UTamaSS"
      "username",// null
      "email",// "dwiutamabagus@gmail.com"
    
      "created_at",// "2018-03-03 20:58:57"
      "updated_at",// "2018-03-31 14:55:12"
      "deleted_at",// null
      "member_or_not",// 0
      "active",// 0
      "unique_code",// 927864
      "keyword",// "R3VuYWthbjEyMyE="
      "regional_id",// null
      "final_submit",// 1
      "comt",// "2233 03-04-2018 07:18:08"
      "send_broadcast",// 1
      "user_id",// 6
      "achievement",// null
      "date_from",// null
      "date_end",// null
      "duration",// null
      "position_id",// null
      "phone_leader",// null
      "email_leader",// null
      "description",// null
      "achievement_2",// null
      "date_from_2",// null
      "date_end_2",// null
      "duration_2",// null
      "position_id_2",// null
      "phone_leader_2",// null
      "email_leader_2",// null
      "description_2",// null
      "achievement_3",// null
      "date_from_3",// null
      "date_end_3",// null
      "duration_3",// null
      "position_id_3",// null
      "phone_leader_3",// null
      "email_leader_3",// null
      "description_3",// null
      "is_ready",// 1
      "position_name",// null
      "position_name_2",// null
      "position_name_3",// null
      "fim_reference",// null
      "fim_reference_id",// null
      "why_join_fim",// null
      "skill_for_fim",// null
      "performance_apiekspresi",// null
      "mbti_id",// null
      "best_performance_id",// null
      "strength",// null
      "weakness",// null
      "role_model",// null
      "problem_solver",// null
      "cintakasih",// null
      "integritas",// null
      "kebersahajaan",// 2
      "totalitas",// 3
      "solidaritas",// 4
      "keadilan",// 5
      "keteladanan",// null
      "mbti",// null
      "best_performance",// null
      "role_model_2",// null
      "role_model_3",// null
      "problem_solver_2",// null
      "problem_solver_3",// null
      "full_name",// null
      "generation",// null
      "majors",// null
      "institution",// null
      "address",// null
      "city",// "Bogor"
      "lat",// null
      "lng",// null
      "phone",// "85749599055"
      "gender",// null
      "photo_profile_link",// null
      "ktp_link",// null
      "blood",// null
      "born_date",// null
      "born_city",// null
      "born_lat",// null
      "born_lng",// null
      "marriage_status",// null
      "address_format",// null
      "facebook",// null
      "instagram",// null
      "blog",// null
      "line",// null
      "disease_history",// null
      "video_profile",// null
      "religion",// null
      "institution_id",// null
        ];
    }

}
