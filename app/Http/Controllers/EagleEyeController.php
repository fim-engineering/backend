<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Bogardo\Mailgun\Mail\Message;
use App\models\achievement_best;
use Illuminate\Http\Request;
use App\models\personality;
use App\models\me_and_fim;
use App\models\profile;
use App\User;
use Mailgun;
use JWTAuth;



class EagleEyeController extends Controller
{
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
        $full_name            = $profile->full_name;
        $generation           = $profile->generation;
        $majors               = $profile->majors;
        $institution          = $profile->institution;
        $address              = $profile->address;
        $city                 = $profile->city;
        $phone                = $profile->phone;
        $gender               = $profile->gender;
        $photo_profile_link   = $profile->photo_profile_link;
        $ktp_link             = $profile->ktp_link;
        $blood                = $profile->blood;
        $born_date            = $profile->born_date;
        $born_city            = $profile->born_city;
        $marriage_status      = $profile->marriage_status;
        $address_format       = $profile->address_format;
        $facebook             = $profile->facebook;
        $instagram            = $profile->instagram;
        $disease_history      = $profile->disease_history;
        $religion             = $profile->religion;

        if ($full_name == NULL) {
          $null++;
          $notif[]= "Kolom nama lengkap belum diisi";
        }else {
          $point++;
        }

        if ($generation == NULL) {
          $null++;
          $notif[]= "Kolom Angkatan belum diisi";
        }else {
          $point++;
        }

        if ($institution == NULL) {
          $null++;
          $notif[]= "Kolom Institusi belum diisi";
        }else {
          $point++;
        }

        if ($majors == NULL) {
          $null++;
          $notif[]= "Kolom Jurusan belum diisi";
        }else {
          $point++;
        }

        if ($address == NULL) {
          $null++;
          $notif[]= "Kolom Alamat belum diisi";
        }else {
          $point++;
        }

        if ($city == NULL) {
          $null++;
          $notif[]= "Kolom Kota belum diisi";
        }else {
          $point++;
        }

        if ($phone == NULL) {
          $null++;
          $notif[]= "Kolom Nomor Telepon belum diisi";
        }else {
          $point++;
        }

        if ($gender == NULL) {
          $null++;
          $notif[]= "Kolom Jenis Kelamin belum diisi";
        }else {
          $point++;
        }

        if ($photo_profile_link == NULL) {
          $null++;
          $notif[]= "Foto Belum diupload";
        }else {
          $point++;
        }

        if ($ktp_link == NULL) {
          $null++;
          $notif[]= "Foto KTP Belum diupload";
        }else {
          $point++;
        }

        if ($blood == NULL) {
          $null++;
          $notif[]= "Kolom Golongan Darah belum diisi";
        }else {
          $point++;
        }

        if ($born_date == NULL) {
          $null++;
          $notif[]= "Kolom Tanggal Lahir belum diisi";
        }else {
          $point++;
        }

        if ($born_city == NULL) {
          $null++;
          $notif[]= "Kolom Tempat Lahir belum diisi";
        }else {
          $point++;
        }

        if ($marriage_status == NULL) {
          $null++;
          $notif[]= "Kolom Status Pernikahan belum diisi";
        }else {
          $point++;
        }

        if ($facebook == NULL) {
          $null++;
          $notif[]= "Kolom Profil Facebook belum diisi";
        }else {
          $point++;
        }

        if ($instagram == NULL) {
          $null++;
          $notif[]= "Kolom Instagram belum diisi";
        }else {
          $point++;
        }

        if ($disease_history == NULL) {
          $null++;
          $notif[]= "Kolom Riwayat Penyakit belum diisi";
        }else {
          $point++;
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
        'null' =>$null,
        'notif' =>$notif,
        'status' =>$status,
      ]);

    }


    public function forgotpassword(Request $request)
    {
      $user = User::where('email', $request->json('email'))->first();
      $email_data = array('user' =>$user , );
      $theemail = $user->email;

      Mailgun::send('email.verificationUser', $email_data, function ($message) use ($theemail) {
          $message->to($theemail)->subject('Selamat datang Pemuda/i Indonesia di Portal Forum Indonesia Muda');
      });

      return response()->json([
        'status' =>"E-mail Sent",
        'code' =>200
      ]);
    }
}
