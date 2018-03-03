<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Bogardo\Mailgun\Mail\Message;
use Illuminate\Support\Facades\DB;
use App\models\achievement_best;
use Illuminate\Http\Request;
use App\models\personality;
use App\models\me_and_fim;
use App\models\profile;
use App\models\regional;
use App\User;
use Carbon\Carbon;
use Mailgun;
use JWTAuth;



class EagleEyeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['count_all_user','day_by_day','count_each_regional']]);
    }

    public function status()
    {
      $user = auth()->user();

      $profile      = $user->profiles;
      if ($profile     !== null) {
        $profile      = $user->profiles->is_ready;
      }else {
        $profile      = "xxx";
      }
      $achievement  = $user->achievement_bests;
      if ($achievement !== null) {
        $achievement  = $user->achievement_bests->is_ready;
      }else {
        $achievement  = "xxx";
      }
      $personality  = $user->personality;
      if ($personality !== null) {
        $personality  = $user->personality->is_ready;
      }else {
        $personality  = "xxx";
      }
      $meandfim     = $user->me_and_fim;
      if ($meandfim    !== null) {
        $meandfim     = $user->me_and_fim->is_ready;
      }else {
        $meandfim     = "xxx";
      }
      $final        = $user->final_submit;

      return response()->json([
        'status_profile' =>$profile,
        'status_achievement' =>$achievement,
        'status_personality' =>$personality,
        'status_meandfim' =>$meandfim,
        'final' =>$final,
      ]);

    }

    public function confirm(Request $request)
    {
      $user = auth()->user();

      $profile      = $user->profiles;
      if ($profile     !== null) {
        $profile      = 1;
      }
      $achievement  = $user->achievement_bests;
      if ($achievement !== null) {
        $achievement  = 1;
      }
      $personality  = $user->personality;
      if ($personality !== null) {
        $personality  = 1;
      }
      $meandfim     = $user->me_and_fim;
      if ($meandfim    !== null) {
        $meandfim     = 1;
      }


      $user->final_submit = 1;
      $user->update();

      $email_data = array('user' =>$user , );

      $theemail = $user->email;

      Mailgun::send('email.final-submission-user', $email_data, function ($message) use ($theemail) {
          $message->to($theemail)->subject('Terima Kasih, Pendaftaranmu Telah Lengkap');
      });


      return response()->json([
        'message'=>'Data Updated',
        'code'=> 200,
      ]);
    }


    public function revert_confirm(Request $request)
    {
      $user = auth()->user();

      $profile      = $user->profiles;
      if ($profile     !== null) {
        $profile      = 0;
      }
      $achievement  = $user->achievement_bests;
      if ($achievement !== null) {
        $achievement  = 0;
      }
      $personality  = $user->personality;
      if ($personality !== null) {
        $personality  = 0;
      }
      $meandfim     = $user->me_and_fim;
      if ($meandfim    !== null) {
        $meandfim     = 0;
      }

      $user->final_submit = 0;
      $user->update();

      return response()->json([
        'message'=>'Data Reverted',
        'code'=> 200,
      ]);
    }

    public function check_profile()
    {
      $user = auth()->user();
      $regional_id = $user->regional_id;

      $profile      = $user->profiles;

      $point = 0;
      $null = 0;

      if ($regional_id == NULL) {
        $null++;
        $notif[]= "Kolom Regional belum diisi";
      }else {
        $point++;
      }

      if ($profile     !== null) {
        $column = array(
        'Nama Lengkap'  => $profile->full_name,
        'Angkatan'  => $profile->generation,
        'Jurusan'  => $profile->majors,
        'Institusi'  => $profile->institution,
        'Alamat'  => $profile->address,
        'Kota'  => $profile->city,
        'Nomor Handphone'  => $profile->phone,
        'Jenis Kelamin'  => $profile->gender,
        'Foto Profil'  => $profile->photo_profile_link,
        'Foto KTP'  => $profile->ktp_link,
        'Golongan Darah'  => $profile->blood,
        'Tanggal Lahir'  => $profile->born_date,
        'Tempat Lahir'  => $profile->born_city,
        'Status Pernikahan'  => $profile->marriage_status,
        'Link Facebook'  => $profile->facebook,
        'Username Instagram'  => $profile->instagram,
        'Riwayat Penyakit'  => $profile->disease_history,
        'Agama'  => $profile->religion,
      );

      foreach ($column as $key => $value) {
        if ($value == NULL) {
          $null++;
          $notif[]= "Kolom $key belum diisi";
        }else {
          $point++;
        }
      }

      }else {
        $notif[]      = "Data Diri Belum Diisi Sama Sekali";
        $null = 18;
      }

      /**
       * Perhitungan
       */

      if ($point >=17 ) {
        $status = true;
      }else {
        $status = false;
      }

      return response()->json([
        'null' =>$null,
        'notif' =>$notif,
        'status' =>$status,
      ]);

    }


    public function check_achievement()
    {
      $user = auth()->user();

      $point = 0;
      $null = 0;

      $achievement  = $user->achievement_bests;
      if ($achievement !== null) {
        $column = array(
          /**
           * Pencapaian Pertama
           */
          'Nama Pencapaian Pertama' => $achievement->achievement,
          'Tanggal Awal Pencapaian Pertama' => $achievement->date_from,
          'Tanggal Akhir Pencapaian Pertama' => $achievement->date_end,
          'Jenis Posisi Pencapaian Pertama' => $achievement->position_name,
          'Email Atasan Pencapaian Pertama' => $achievement->email_leader,
          'Nomor Telepon Atasan Pencapaian Pertama' => $achievement->phone_leader,
          'Deskripsi Pencapaian Pertama' => $achievement->description,

          /**
           * Pencapaian Kedua
           */

           'Nama Pencapaian Ke-2' => $achievement->achievement_2,
           'Tanggal Awal Pencapaian Ke-2' => $achievement->date_from_2,
           'Tanggal Akhir Pencapaian Ke-2' => $achievement->date_end_2,
           'Jenis Posisi Pencapaian Ke-2' => $achievement->position_name_2,
           'Email Atasan Pencapaian Ke-2' => $achievement->email_leader_2,
           'Nomor Telepon Atasan Pencapaian Ke-2' => $achievement->phone_leader_2,
           'Deskripsi Pencapaian Ke-2' => $achievement->description_2,

           /**
            * Pencapaian Ketiga
            */


            'Nama Pencapaian Ke-3' => $achievement->achievement_3,
            'Tanggal Awal Pencapaian Ke-3' => $achievement->date_from_3,
            'Tanggal Akhir Pencapaian Ke-3' => $achievement->date_end_3,
            'Jenis Posisi Pencapaian Ke-3' => $achievement->position_name_3,
            'Email Atasan Pencapaian Ke-3' => $achievement->email_leader_3,
            'Nomor Telepon Atasan Pencapaian Ke-3' => $achievement->phone_leader_3,
            'Deskripsi Pencapaian Ke-3' => $achievement->description_3,

        );


        foreach ($column as $key => $value) {
          if ($value == NULL) {
            $null++;
            $notif[]= "Kolom $key belum diisi";
          }else {
            $point++;
          }
        }


      }else {
        $notif[]  = "Data Aktivitas dan Kepribadian Belum Diisi Sama Sekali";
        $null     = 21;
      }

      /**
       * Perhitungan
       */

      if ($point >=20 ) {
        $status = true;
      }else {
        $status = false;
      }

      return response()->json([
        'null' =>$null,
        'notif' =>$notif,
        'status' =>$status,
      ]);

    }


    public function check_personality()
    {
      $user = auth()->user();

      $point = 0;
      $null = 0;

      $personality  = $user->personality;
      if ($personality !== null) {
        $column = array(
          /**
           * Personality Check
           */
          'Tipe MBTI' => $personality->mbti,
          '3 Kekuatan' => $personality->strength,
          '3 Kelemahan' => $personality->weakness,
          'Performance Paling Baik saat di Organisasi' => $personality->best_performance,
          'Tokoh Idola Ke-1' => $personality->role_model,
          'Tokoh Idola Ke-2' => $personality->role_model_2,
          'Tokoh Idola Ke-3' => $personality->role_model_3,
          'Masalah Anak Muda Ke-1' => $personality->problem_solver,
          'Masalah Anak Muda Ke-2' => $personality->problem_solver_2,
          'Masalah Anak Muda Ke-3' => $personality->problem_solver_3,
          'Nilai Kondisi Anak Muda (Cinta Kasih)' => $personality->cintakasih,
          'Nilai Kondisi Anak Muda (Integritas)' => $personality->integritas,
          'Nilai Kondisi Anak Muda (Kebersahajaan)' => $personality->Kebersahajaan,
          'Nilai Kondisi Anak Muda (Totalitas)' => $personality->totalitas,
          'Nilai Kondisi Anak Muda (Solidaritas)' => $personality->solidaritas,
          'Nilai Kondisi Anak Muda (Keadilan)' => $personality->keadilan,
          'Nilai Kondisi Anak Muda (Keteladanan)' => $personality->keteladanan,
        );

        foreach ($column as $key => $value) {
          if ($value == NULL) {
            $null++;
            $notif[]= "Kolom $key belum diisi";
          }else {
            $point++;
          }
        }

      }else {
        $notif[]  = "Data Personality Belum Diisi Sama Sekali";
        $null     = 17;
      }

      /**
       * Perhitungan Personality
       */

      if ($point >=16 ) {
        $status = true;
      }else {
        $status = false;
      }

      return response()->json([
        'data'=>$meandfim,
        'null' =>$null,
        'notif' =>$notif,
        'status' =>$status,
      ]);


    }


    public function check_meandfim()
    {
      $user = auth()->user();

      $point = 0;
      $null = 0;

      $meandfim     = $user->me_and_fim;
      if ($meandfim    !== null) {

        $column = array(
          'Mengetahui FIM dari Mana' => $meandfim->mbti,
          'Mengapa Kamu Ingin Bergabung FIM' => $meandfim->strength,
          'Skill / Sumberdaya Apa yang Bisa Dikontribusikan' => $meandfim->weakness,
          'Bakat yang Akan Ditampilkan di Api Ekspresi' => $meandfim->best_performance,
          );

          foreach ($column as $key => $value) {
            if ($value == NULL) {
              $null++;
              $notif[]= "Kolom $key belum diisi";
            }else {
              $point++;
            }
          }

      }else {
        $notif[]  = "Data Tentang Aku dan FIM Belum Diisi Sama Sekali";
        $null     = 4;
      }

      /**
       * Perhitungan Personality
       */

      if ($point >=4 ) {
        $status = true;
      }else {
        $status = false;
      }

      return response()->json([
        'data'=>$meandfim,
        'null' =>$null,
        'notif' =>$notif,
        'status' =>$status,
      ]);

    }


    public function all_validation()
    {
      $user = auth()->user();
      $regional_id = $user->regional_id;


      $profile      = $user->profiles;
      $achievement  = $user->achievement_bests;
      $personality  = $user->personality;
      $meandfim     = $user->me_and_fim;
      $null =0;
      $point=0;

      // if ($regional_id == NULL) {
      //   $null++;
      //   $notif[]= "Kolom Regional belum diisi";
      // }else {
      //   $point++;
      // }

      if ($profile     !== null) {
        $column[] = array(
        'Nama Lengkap'  => $profile->full_name,
        'Angkatan'  => $profile->generation,
        'Jurusan'  => $profile->majors,
        'Institusi'  => $profile->institution,
        'Alamat'  => $profile->address,
        'Kota'  => $profile->city,
        'Nomor Handphone'  => $profile->phone,
        'Jenis Kelamin'  => $profile->gender,
        'Foto Profil'  => $profile->photo_profile_link,
        'Foto KTP'  => $profile->ktp_link,
        'Golongan Darah'  => $profile->blood,
        'Tanggal Lahir'  => $profile->born_date,
        'Tempat Lahir'  => $profile->born_city,
        'Status Pernikahan'  => $profile->marriage_status,
        'Link Facebook'  => $profile->facebook,
        'Username Instagram'  => $profile->instagram,
        'Riwayat Penyakit'  => $profile->disease_history,
        'Agama'  => $profile->religion,
      );

      if ($achievement !== null) {
        $column[] = array(
          /**
           * Pencapaian Pertama
           */
          'Nama Pencapaian Pertama' => $achievement->achievement,
          'Tanggal Awal Pencapaian Pertama' => $achievement->date_from,
          'Tanggal Akhir Pencapaian Pertama' => $achievement->date_end,
          'Jenis Posisi Pencapaian Pertama' => $achievement->position_name,
          'Email Atasan Pencapaian Pertama' => $achievement->email_leader,
          'Nomor Telepon Atasan Pencapaian Pertama' => $achievement->phone_leader,
          'Deskripsi Pencapaian Pertama' => $achievement->description,

          /**
           * Pencapaian Kedua
           */

           'Nama Pencapaian Ke-2' => $achievement->achievement_2,
           'Tanggal Awal Pencapaian Ke-2' => $achievement->date_from_2,
           'Tanggal Akhir Pencapaian Ke-2' => $achievement->date_end_2,
           'Jenis Posisi Pencapaian Ke-2' => $achievement->position_name_2,
           'Email Atasan Pencapaian Ke-2' => $achievement->email_leader_2,
           'Nomor Telepon Atasan Pencapaian Ke-2' => $achievement->phone_leader_2,
           'Deskripsi Pencapaian Ke-2' => $achievement->description_2,

           /**
            * Pencapaian Ketiga
            */


            'Nama Pencapaian Ke-3' => $achievement->achievement_3,
            'Tanggal Awal Pencapaian Ke-3' => $achievement->date_from_3,
            'Tanggal Akhir Pencapaian Ke-3' => $achievement->date_end_3,
            'Jenis Posisi Pencapaian Ke-3' => $achievement->position_name_3,
            'Email Atasan Pencapaian Ke-3' => $achievement->email_leader_3,
            'Nomor Telepon Atasan Pencapaian Ke-3' => $achievement->phone_leader_3,
            'Deskripsi Pencapaian Ke-3' => $achievement->description_3,
        );
      }

      if ($personality !== null) {
        $column[] = array(
          /**
           * Personality Check
           */
          'Tipe MBTI' => $personality->mbti,
          '3 Kekuatan' => $personality->strength,
          '3 Kelemahan' => $personality->weakness,
          'Performance Paling Baik saat di Organisasi' => $personality->best_performance,
          'Tokoh Idola Ke-1' => $personality->role_model,
          'Tokoh Idola Ke-2' => $personality->role_model_2,
          'Tokoh Idola Ke-3' => $personality->role_model_3,
          'Masalah Anak Muda Ke-1' => $personality->problem_solver,
          'Masalah Anak Muda Ke-2' => $personality->problem_solver_2,
          'Masalah Anak Muda Ke-3' => $personality->problem_solver_3,
          'Nilai Kondisi Anak Muda (Cinta Kasih)' => $personality->cintakasih,
          'Nilai Kondisi Anak Muda (Integritas)' => $personality->integritas,
          'Nilai Kondisi Anak Muda (Kebersahajaan)' => $personality->Kebersahajaan,
          'Nilai Kondisi Anak Muda (Totalitas)' => $personality->totalitas,
          'Nilai Kondisi Anak Muda (Solidaritas)' => $personality->solidaritas,
          'Nilai Kondisi Anak Muda (Keadilan)' => $personality->keadilan,
          'Nilai Kondisi Anak Muda (Keteladanan)' => $personality->keteladanan,
        );
      }

      if ($meandfim    !== null) {

        $column[] = array(
          'Mengetahui FIM dari Mana' => $meandfim->mbti,
          'Mengapa Kamu Ingin Bergabung FIM' => $meandfim->strength,
          'Skill / Sumberdaya Apa yang Bisa Dikontribusikan' => $meandfim->weakness,
          'Bakat yang Akan Ditampilkan di Api Ekspresi' => $meandfim->best_performance,
          );
        }


          foreach ($column as $key => $table)
          {
            $data[] = $table;

            /**
             * Seluruh Notif dan Null
             */
            foreach ($table as $key => $value) {
              if ($value == NULL) {
                $null++;
                $notif[]= "Kolom $key belum diisi";
              }else {
                $point++;
              }
            }
          }



          if (count($notif) == 0) {
            $status = true;
          }else {
            $status = false;
          }



          return response()->json([
            'data' => $data,
            'null' =>$null,
            'notif' =>$notif,
            'status' =>$status,
          ]);
      }

    }


    // Jumlah Seluruh Pendaftar
    public function count_all_user()
    {
      $pendaftar =User::all()->count();
      $submit = User::where('final_submit', 1)->count();

      return response()->json([
        'registered' => $pendaftar,
        'submited'  => $submit,
        'code' => 200
      ]);
    }

    public function day_by_day()
    {
      $start_day1 = Carbon::create(2018, 2, 27, 0, 0, 0, 'Asia/Jakarta');
      $start_day = $start_day1->setTime(0, 0, 0);

      $start_day = date_format($start_day, 'Y-m-d');
      $start_day = strtotime($start_day);

      $end_day1 = Carbon::now();

      $end_day = $end_day1->setTime(23, 59, 59);
      $end_day = date_format($end_day, 'Y-m-d');
      $end_day = strtotime("+1 day", strtotime($end_day));


      $hari   = array();


      for ($i=$start_day; $i < $end_day ; $i+= (60*60*24)) {
          $hari[]=date("Y-m-d",$i);
        }

        foreach ($hari as $key => $date) {
          $count_registered[$date] = User::whereDate('created_at', $date)->count();
          $count_submited[$date] = User::whereDate('created_at', $date)->where('final_submit', 1)->count();

        }

        return response()->json([
          'registered' => $count_registered,
          'submited' => $count_submited,
          'code' => 200
        ]);

    }

    public function count_each_regional()
    {
       $regionals = regional::orderBy('regional_name','asc')->get();

       foreach ($regionals as $key => $regional) {
         $count_registered[$regional->regional_name] = Profile::where('city', $regional->regional_name)->count();
         // $count_submited[$regional->regional_name] =
         // Profile::where('city', $regional->regional_name)
         // ->where('final_submit', 1)->count();

         $count_submited[$regional->regional_name] =
         DB::table('users')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->where([['profiles.city', $regional->regional_name],['users.final_submit', 1]])->count();
       }

       

       return response()->json([
         'registered' => $count_registered,
         'submited' => $count_submited,
         'code' => 200
       ]);

    }

    public function data_user()
    {
      $users = User::all();
      $profile = profile::all();



      foreach ($users as $key => $user) {
        $pers = $user->personality;
        if ($pers == NULL) {
          // $personality= new personality;
          // $personality->user_id = $user->id;
          // $personality->save();
        }

        $usr = $user->profiles;
        if ($usr == NULL) {
          // $profile = new profile;
          // $profile->user_id = $user->id;
          // $profile->is_ready = 0;
          // $profile->save();
        }

        $ach = $user->achievement_bests;
        if ($ach == NULL) {
          // $achievement = new achievement_best;
          // $achievement->user_id = $user->id;
          // $achievement->save();
        }

        $meand = $user->me_and_fim;
        if ($meand == NULL) {
          // $meandfim = new me_and_fim;
          // $meandfim->user_id = $user->id;
          // $meandfim->save();
        }



      }

      return response()->json([
        // 'user' => $user,
        'profile'=>$users,
        'code' => 200
      ]);
    }



}
