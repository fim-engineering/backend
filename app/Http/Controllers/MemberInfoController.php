<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\User;
use App\profile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

use Illuminate\Http\Request;

class MemberInfoController extends Controller
{
    //

    public function all(Request $request)
    {

      $all_user = DB::table('users')
         ->join('profiles', 'users.id', '=', 'profiles.user_id')
         ->join('achievement_bests', 'users.id', '=', 'achievement_bests.user_id')
         ->join('me_and_fims', 'users.id', '=', 'me_and_fims.user_id')
         ->join('personalities', 'users.id', '=', 'personalities.user_id')
         ->get();


      return response()->json([
        'user_data' => $all_user,
        'code' => 200,
      ]);
    }

    public function all_submit(Request $request)
    {
      $all_submit = DB::table('users')
         ->join('profiles', 'users.id', '=', 'profiles.user_id')
         ->join('achievement_bests', 'users.id', '=', 'achievement_bests.user_id')
         ->join('me_and_fims', 'users.id', '=', 'me_and_fims.user_id')
         ->join('personalities', 'users.id', '=', 'personalities.user_id')
         ->where('users.final_submit', 1)
         ->get();

         return response()->json([
           'user_data' => $all_submit,
           'code' => 200,
         ]);

    }

    public function all_submit_yet(Request $request)
    {
      $all_submit = DB::table('users')
         ->join('profiles', 'users.id', '=', 'profiles.user_id')
         // ->join('achievement_bests', 'users.id', '=', 'achievement_bests.user_id')
         // ->join('me_and_fims', 'users.id', '=', 'me_and_fims.user_id')
         // ->join('personalities', 'users.id', '=', 'personalities.user_id')
         ->where('users.final_submit', 0)->get();
         // ->paginate(20);

         return response()->json([
           'user_data' => $all_submit,
           'code' => 200,
         ]);

    }

    public function by_regional_all(Request $request)
    {

      if ($request->json('regional')) {
         $regional_all = DB::table('users')
        ->join('profiles', 'users.id', '=', 'profiles.user_id')
        ->join('achievement_bests', 'users.id', '=', 'achievement_bests.user_id')
        ->join('me_and_fims', 'users.id', '=', 'me_and_fims.user_id')
        ->join('personalities', 'users.id', '=', 'personalities.user_id')
        ->where('profiles.city', $request->json('regional'))
        ->get();
      }else {
        $regional_all = "need regional json value";
      }

      return response()->json([
        'user_data' => $regional_all,
        'code' => 200,
      ]);
    }


    public function by_regional_submit(Request $request)
    {

      if ($request->json('regional')) {
        $regional_all = DB::table('users')
        ->join('profiles', 'users.id', '=', 'profiles.user_id')
        ->join('achievement_bests', 'users.id', '=', 'achievement_bests.user_id')
        ->join('me_and_fims', 'users.id', '=', 'me_and_fims.user_id')
        ->join('personalities', 'users.id', '=', 'personalities.user_id')
        ->where([['profiles.city', $request->json('regional')],['users.final_submit', 1]])
        ->get();
      }else {
        $regional_all ="need regional json value";
      }

         return response()->json([
           'user_data' => $regional_all,
           'code' => 200,
         ]);
    }

    public function by_regional_submit_yet(Request $request)
    {

      if ($request->json('regional')) {
        $regional_all = DB::table('users')
        ->join('profiles', 'users.id', '=', 'profiles.user_id')
        // ->join('achievement_bests', 'users.id', '=', 'achievement_bests.user_id')
        // ->join('me_and_fims', 'users.id', '=', 'me_and_fims.user_id')
        // ->join('personalities', 'users.id', '=', 'personalities.user_id')
        ->where([['profiles.city', $request->json('regional')],['users.final_submit', 0]])
        ->get();
      }else {
        $regional_all ="need regional json value";
      }

         return response()->json([
           'user_data' => $regional_all,
           'code' => 200,
         ]);
    }


    // Ada peserta yang belum isi regional
    public function list_index_peserta()
    {
      $all_submit = DB::table('users')
         ->join('profiles', 'users.id', '=', 'profiles.user_id')
         ->whereNull('profiles.city')->paginate(20);


        $data = array('members' => $all_submit , );
      return view('list-peserta-regional-null')->with($data);

    }

    public function list_index_peserta_submit_yet()
    {
      $all_submit = DB::table('users')
         ->join('profiles', 'users.id', '=', 'profiles.user_id')
         ->where([['users.send_broadcast', 2]])->paginate(20);


        $data = array('members' => $all_submit , );
      return view('list-peserta-regional-null')->with($data);
    }

    // Ajax Record
    public function add_record_broadcast()
    {
      $nama = $_GET['name'];
      $email = $_GET['email'];
      $message= $_GET['message'];

      // $message= urlencode($message);

      $adduser = User::where('email',$email)->first();
      $adduser->final_submit = 0;
      $adduser->comt = $nama.' '.Carbon::now()->format('d-m-Y H:i:s');
      $adduser->save();

      $phone = $adduser->profiles->phone;
      if ($phone !== NULL) {
        $phone_subs = substr($phone,0,1);

        if ($phone_subs == "0") {
          $phone_subs = substr_replace($phone,"62",0,1);
        }elseif ($phone_subs == "8") {
          $phone_subs = substr_replace($phone,"62",0,0);
        }
        else {
          $phone_subs = $phone;
        }
      }

      $link = "https://api.whatsapp.com/send?phone=$phone_subs&text=$message";


      if ($adduser) {
        # code...
        return Response::json([
          'status' => 'Opened',
          'desc'=> $adduser->comt,
          'message' => "Berhasil",
          'link'=>$link
        ], 200);
      }else {
        # code...
        return Response::json([
          'status' => 'error',
          'message' => "gagal",
        ], 200);
      }
    }

    // cari orang yang belum ngisi regional
    public function get_person_who_not_fill_regional()
    {
      $all_submit = DB::table('users')
         ->join('profiles', 'users.id', '=', 'profiles.user_id')
         ->join('achievement_bests', 'users.id', '=', 'achievement_bests.user_id')
         ->join('me_and_fims', 'users.id', '=', 'me_and_fims.user_id')
         ->join('personalities', 'users.id', '=', 'personalities.user_id')
         ->where([['profiles.city', NULL],['users.final_submit', 1]])->get();


         // ->paginate(20);


         foreach ($all_submit as $key => $value) {
           $usersd = User::where('email', $value->email)->first();

           $validation = $this->user_validation($usersd['email']);

           if ($validation['null'] <4) {
             if ($usersd) {
               # code...
               $usersd->send_broadcast = 1; // regional
               $usersd->save();
             }
           }

         }

         dd("success-bro");

         return response()->json([
           'user_data' => $all_submit,
           'code' => 200,
         ]);
    }

    // Hanya yang terlihat niat

    public function user_validation($email)
    {

        $user = User::where('email', $email)->first();
        if ($user !== NULL) {
          # code...
          $regional_id = $user->regional_id;

          $profile      = $user->profiles;
          $achievement  = $user->achievement_bests;
          $personality  = $user->personality;
          $meandfim     = $user->me_and_fim;
          $null =0;
          $point=0;


          if ($profile     !== null) {
            $column[] = array(
              'Nama Lengkap'  => $profile->full_name,
              'Angkatan'  => $profile->generation,
              'Jurusan'  => $profile->majors,
              'Institusi'  => $profile->institution,
              'Alamat'  => $profile->address,
              'Regional'  => $profile->city,
              'Nomor Handphone'  => $profile->phone,
              'Jenis Kelamin'  => $profile->gender,
              'Foto Profil'  => $profile->photo_profile_link,
              'Foto KTP'  => $profile->ktp_link,
              'Golongan Darah'  => $profile->blood,
              'Tanggal Lahir'  => $profile->born_date,
              'Tempat Lahir'  => $profile->born_city,
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
                // 'Nilai Kondisi Anak Muda (Kebersahajaan)' => $personality->Kebersahajaan,
                'Nilai Kondisi Anak Muda (Totalitas)' => $personality->totalitas,
                'Nilai Kondisi Anak Muda (Solidaritas)' => $personality->solidaritas,
                'Nilai Kondisi Anak Muda (Keadilan)' => $personality->keadilan,
                'Nilai Kondisi Anak Muda (Keteladanan)' => $personality->keteladanan,
                );
              }

              if ($meandfim    !== null) {

                $column[] = array(
                'Mengetahui FIM dari Mana' => $meandfim->fim_reference,
                'Mengapa Kamu Ingin Bergabung FIM' => $meandfim->why_join_fim,
                'Skill / Sumberdaya Apa yang Bisa Dikontribusikan' => $meandfim->skill_for_fim,
                'Bakat yang Akan Ditampilkan di Api Ekspresi' => $meandfim->performance_apiekspresi,
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


              if (!isset($notif)) {
                $status = true;
                $notif = "Data Lengkap";
              }else {
                $status = false;
              }

              $array = array(
              'null' =>$null,
              'notif' =>$notif,
              'status' =>$status,);

        }else {
          $array = array(
          'null' =>100,
          'notif' =>"-",
          'status' =>false,
          );
        }

            return $array;
            // return response()->json([
            //   // 'data' => $data,
            //   'null' =>$null,
            //   'notif' =>$notif,
            //   'status' =>$status,
            // ]);
        }
    }
}
