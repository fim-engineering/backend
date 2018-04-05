<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="{{asset('js/sweetalert/sweetalert2.js')}}"></script>
    <link href="{{asset('js/sweetalert/sweetalert2.css')}}" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <style media="screen">
    .grey{
      color:grey;
    }
  </style>

  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <form class="" action="/get-data-member/download" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="regional" value="{{$regional}}">
            <button type="submit" class="btn btn-success btn-block">
              Download Excel
            </button>
          </form>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">


          <table class="hover table">
            <thead>
              <tr>
                <th>No</th>
                <th>View</th>
                <th>Jumlah Kosong</th>
                <th>Keputusan</th>
                <th>Nama</th>
                <th>Nomor Hp</th>
                <th>E-Mail</th>

              </tr>
            </thead>
            <tbody>
              @php
                $i = 1;
              @endphp

              @foreach ($members as $member)
                @php
                  $juml_null = 1000;
                  $ceknull = app('App\Http\Controllers\MemberInfoController')->user_validation($member->email);
                  $juml_null =$ceknull['null'];


                @endphp

                <tr>
                  <td>{{$i++}}</td>
                  <td>
                    <span class="btn btn-info view" data-toggle="modal" data-target="#detailpeserta">View</span>
                    <input type="hidden" class="email" name="" value="{{$member->email}}">
                  </td>
                  <td>{{$juml_null}}</td>
                  <td>
                    <span class="btn btn-warning tolak">Tolak / Hapus</span>
                  </td>
                  <td>{{$member->name}}</td>
                  <td>{{$member->phone}}</td>
                  <td>{{$member->email}}</td>

                </tr>


              @endforeach

              <script type="text/javascript">


  $('.tolak').on('click', function() {
    swal({
      title: "Are you sure?",
      text: "But you will still be able to retrieve this file.",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#f44336",
      confirmButtonText: "Yes, Delete it!",
      cancelButtonText: "No, cancel please!",

    }).then((result) => {
  if (result.value) {

      var tr = $(this).parent().parent();
      var email = tr.find('.email').val();
      $.ajax({
        url: '/seleksi-berkas/list-peserta/delete',
        type: 'GET',
        context:this,
        dataType: 'json',
        data: {email: email}
      })
      .done(function(data) {
        if (data.status == 'deleted') {
          tr.find('.tolak').addClass('btn-danger').removeClass('btn-warning').text('TERHAPUS !');
        }
      });

      }
    });
  });
</script>

              <script type="text/javascript">
                $(document).ready(function() {
                  // $('.tolak').on('click', function() {
                  //   var tr = $(this).parent().parent();
                  //   var email = tr.find('.email').val();
                  //   $.ajax({
                  //     url: '/seleksi-berkas/list-peserta/delete',
                  //     type: 'GET',
                  //     context:this,
                  //     dataType: 'json',
                  //     data: {email: email}
                  //   })
                  //   .done(function(data) {
                  //     if (data.status == 'deleted') {
                  //       tr.find('.tolak').addClass('btn-danger').removeClass('btn-warning').text('TERHAPUS !');
                  //     }
                  //   });
                  // });

                  $('.view').on('click',function(event) {
                    var tr = $(this).parent().parent();
                    var email = tr.find('.email').val();

                    $.ajax({
                      url: '/get-data-member',
                      type: 'GET',
                      context:this,
                      dataType: 'json',
                      data: {email: email}
                    })
                    .done(function(data) {
                      console.log(data);
                      $('#name').text(data.user.name);
                      $('#name_2').text(data.user.name);

          $('#city').text(data. profile.city);
          $('#photo_profile_link').attr('src',data.profile.photo_profile_link);
          $('#ktp_link').attr('src',data.profile.ktp_link);
          $('#institution').text(data. profile.institution);
          $('#majors').text(data. profile .majors);
          $('#phone').text(data. profile .phone);
          $('#email_ya').text(data. profile .email);
          $('#gender').text(data. profile .gender);
          $('#blood').text(data. profile .blood);
          $('#religion').text(data. profile .religion);

          $('#facebook').val(data. profile .facebook);
          $('#instagram').val(data. profile .instagram);
          $('#blog').val(data. profile .blog);
          $('#video_profile').val(data. profile .video_profile);

          $('#address').text(data. profile .address);
          $('#city').text(data. profile .city);
          $('#born_city').text(data. profile .born_city);
          $('#born_date').text(data. profile .born_date);
          $('#disease_history').text(data. profile .disease_history);
          $('#best_performance_id').text(data. personality.best_performance_id);
          $('#strength').text(data. personality.strength);
          $('#weakness').text(data. personality.weakness);
          $('#role_model').text(data. personality.role_model);
          $('#role_model_2').text(data. personality.role_model_2);
          $('#role_model_3').text(data. personality.role_model_3);
          $('#problem_solver').text(data. personality.problem_solver);
          $('#problem_solver_2').text(data. personality.problem_solver_2);
          $('#problem_solver_3').text(data. personality.problem_solver_3);
          $('#mbti').text(data. personality.mbti);


          function hitung_presentase(nilai) {
            return hasil_perhitungan = nilai/5*100;
          }

          $('#cintakasih').css('width', hitung_presentase(data. personality.cintakasih)+'%');
          $('#integritas').css('width', hitung_presentase(data. personality.integritas)+'%');
          $('#totalitas').css('width', hitung_presentase(data. personality.totalitas)+'%');
          $('#kebersahajaan').css('width', hitung_presentase(data. personality.kebersahajaan)+'%');
          $('#solidaritas').css('width', hitung_presentase(data. personality.solidaritas)+'%');
          $('#keadilan').css('width', hitung_presentase(data. personality.keadilan)+'%');
          $('#keteladanan').css('width', hitung_presentase(data. personality.keteladanan)+'%');
          $('#achievement').css('width', hitung_presentase(data. achievement.achievement)+'%');


          $('#cintakasih').text('cintakasih ('+data. personality.cintakasih+')');
          $('#integritas').text('integritas ('+data. personality.integritas+')');
          $('#totalitas').text('totalitas ('+data. personality.totalitas+')');
          $('#kebersahajaan').text('kebersahajaan ('+data. personality.kebersahajaan+')');
          $('#solidaritas').text('solidaritas ('+data. personality.solidaritas+')');
          $('#keadilan').text('keadilan ('+data. personality.keadilan+')');
          $('#keteladanan').text('keteladanan ('+data. personality.keteladanan+')');
          $('#achievement').text('achievement ('+data. achievement.achievement+')');


          $('#date_from').text(data. achievement.date_from);
          $('#date_end').text(data. achievement.date_end);
          $('#duration').text('Durasi ='+data. achievement.duration+' Tahun');
          $('#position_name').text(data. achievement.position_name);
          $('#email_leader').text(data. achievement.email_leader);
          $('#description').text(data. achievement.description);
          $('#achievement_2').text(data. achievement.achievement_2);
          $('#date_from_2').text(data. achievement.date_from_2);
          $('#date_end_2').text(data. achievement.date_end_2);
          $('#duration_2').text(data. achievement.duration_2);
          $('#position_name_2').text(data. achievement.position_name_2);
          $('#email_leader_2').text(data. achievement.email_leader_2);
          $('#description_2').text(data. achievement.description_2);
          $('#achievement_3').text(data. achievement.achievement_3);
          $('#date_from_3').text(data. achievement.date_from_3);
          $('#date_end_3').text(data. achievement.date_end_3);
          $('#duration_3').text(data. achievement.duration_3);
          $('#position_name_3').text(data. achievement.position_name_3);
          $('#email_leader_3').text(data. achievement.email_leader_3);
          $('#description_3').text(data. achievement.description_3);
          $('#fim_reference').text(data. meandfim.fim_reference);
          $('#why_join_fim').text(data. meandfim.why_join_fim);
          $('#skill_for_fim').text(data. meandfim.skill_for_fim);
          $('#performance_apiekspresi').text(data. meandfim.performance_apiekspresi);
          $('#emailnya').text(data. user.email);





                    });
                  });


                });
              </script>





            </tbody>
          </table>

          {{-- <div class="row">
            {{ $members->links() }}
          </div> --}}




        </div>
      </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="detailpeserta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Detail Peserta</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4">
            <img style="width:250px" id="photo_profile_link" class="img img-responsive" src="https://opensource.google.com/assets/static/images/home/blog/blog_image_1.jpg" alt="">
          </div>
          <div class="col-md-8">
            <h2 id="name">Name</h2>
            <h5>Reg :
              <span id="city">
                Bogor
              </span>
            </h5>
            <h5 id="institution">Institut Pertanian Bogor</h5>
            <p class="grey" id="majors">Pendidikan Bahasa Arab</p>
            <table class="">
              <tr>
                <td class="grey">Phone</td>
                <td id="phone">085749599055</td>
              </tr>
              <tr>
                <td class="grey">email</td>
                <td id="email_ya">dwiutamabagus@gmail.com</td>
              </tr>
              <tr>
                <td class="grey">Gender</td>
                <td id="gender">Male</td>
              </tr>
              <tr>
                <td class="grey">Gol Darah</td>
                <td id="blood">O</td>
              </tr>
              <tr>
                <td class="grey">Agama</td>
                <td id="religion">Islam</td>
              </tr>

            </table>
          </div>
        </div>

        <div class="row" style="margin-top:10px">
          <div class="col-md-6">
            <img id="ktp_link" class="img img-responsive" style="width: 376px;" src="https://singowijaya.files.wordpress.com/2014/04/ktp.jpg" alt="">
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="">
                <span id="facebook" class="input-group-addon">Facebook </span>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="">
                <span id="instagram" class="input-group-addon">Instagram </span>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="">
                <span id="blog" class="input-group-addon">Blog </span>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="">
                <span id="video_profile" class="input-group-addon">Video Profil </span>
              </div>
            </div>

            {{-- <a href="#" target="_blank" class="btn btn-lg btn-primary">Facebook
              <span id="facebook">(Ada)</span>
            </a> <br>
            <a href="#" target="_blank" class="btn btn-lg btn-secondary">Instagram
              <span id="instagram">(Ada)</span>
            </a> <br>
            <a href="#" target="_blank" class="btn btn-lg btn-warning">Blog
              <span id="blog">(Ada)</span>
            </a> <br>
            <a href="#" target="_blank" class="btn btn-lg btn-dark">Video Profil
              <span id="video_profile">(Ada)</span>
            </a> --}}

          </div>
        </div>

        <div class="row">
          <div class="col-md-12">

            <table class="table">
              <tr>
                <td class="grey">Alamat</td>
                <td id="address">Komplek Cetarip Barat, Jl Cetarip Tengah II No.51 RT 03 RW 09 Bojongloa Kaler, Kopo, Bandung</td>
              </tr>
              <tr>
                <td class="grey">Kota</td>
                <td id="city">Bandung</td>
              </tr>
              <tr>
                <td class="grey">Tanggal Lahir</td>
                <td>
                  <span id="born_city">
                    Jombang
                  </span>
                  ,
                  <span id="born_date">
                    16 Agustus 1993 (25 Tahun)</td>
                  </span>
              </tr>
              <tr>
                <td class="grey">Riwayat Penyakit</td>
                <td id="disease_history">Maag</td>
              </tr>
            </table>
          </div>
        </div>


        <div class="row text-center">
          <div class="col-md-12">
            <h2>Kepribadian</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">

            <table class="table">
              <tr>
                <td class="grey">Performa Terbaik</td>
                <td>(1 Kepengurusan | 2 Kepanitiaan | 3 Keduanya) =====>
                  <span id="best_performance_id">
                    3
                  </span>
                </td>
              </tr>
              <tr>
                <td class="grey">Kekuatan</td>
                <td id="strength">Mudah Bersosialisasi, Menerima Kritik dan Saran, Ber-Inisiatif</td>
              </tr>
              <tr>
                <td class="grey">Kelemahan</td>
                <td id="weakness">Moody, Gugup ketika harus berbicara spontan di depan umum, Mudah nge-down ketika plan dirusak</td>
              </tr>
              <tr>
                <td class="grey">Tokoh Idola</td>
                <td>
                  <span id="role_model">Anies Baswedan</span> ,
                  <span id="role_model_2">Ridwan Kamil</span> ,
                  <span id="role_model_3">Sudirman Said</span>
                </td>
              </tr>


              <tr>
                <td class="grey">Problem menurut dia yang harus diselesaikan</td>
                <td>
                  <span id="problem_solver">Krisis Identitas</span> ,
                  <span id="problem_solver_2">Degradasi Moral</span> ,
                  <span id="problem_solver_3">Apatis</span> ,
                </td>
              </tr>
              <tr>
                <td class="grey">MBTI</td>
                <td id="mbti">ESFJ</td>
              </tr>
              <tr>
                <td class="grey">5 Pilar Karakter</td>
                <td>
                  <div class="progress" style="height: 30px;margin-top:10px">
                    <div class="progress-bar bg-success" role="progressbar" id="cintakasih" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">cintakasih
                    </div>
                  </div>
                  <div class="progress" style="height: 30px;margin-top:10px">
                    <div class="progress-bar bg-info" role="progressbar" id="integritas" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">integritas
                    </div>
                  </div>
                  <div class="progress" style="height: 30px;margin-top:10px">
                    <div class="progress-bar bg-primary" role="progressbar" id="totalitas" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">totalitas
                    </div>
                  </div>
                  <div class="progress" style="height: 30px;margin-top:10px">
                    <div class="progress-bar bg-warning" role="progressbar" id="kebersahajaan" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">kebersahajaan
                    </div>
                  </div>
                  <div class="progress" style="height: 30px;margin-top:10px">
                    <div class="progress-bar bg-dark" role="progressbar" id="solidaritas" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">solidaritas
                    </div>
                  </div>
                  <div class="progress" style="height: 30px;margin-top:10px">
                    <div class="progress-bar bg-danger" role="progressbar" id="keadilan" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">keadilan
                    </div>
                  </div>
                  <div class="progress" style="height: 30px;margin-top:10px">
                    <div class="progress-bar bg-info" role="progressbar" id="keteladanan" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">keteladanan
                    </div>
                  </div>
                </td>
              </tr>
            </table>
          </div>
        </div>


        <div class="row text-center">
          <div class="col-md-12">
            <h2>Pencapaian</h2>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <table class="table">
              <tr>
                <td class="grey">Nama Pencapaian</td>
                <td id="achievement"></td>
              </tr>
              <tr>
                <td class="grey">Tanggal</td>
                <td>
                  <span id="date_from">
                    24 April 2017
                  </span>
                  -
                  <span id="date_end">
                    25 April 2018 (Durasi : 1 tahun)
                  </span>
                  <span id="duration">
                   (Durasi : 1 tahun)
                  </span>
                </td>
              </tr>
              <tr>
                <td class="grey">Posisi </td>
                <td id="position_name"></td>
              </tr>
              <tr>
                <td class="grey">Email yang punya Organisasi</td>
                <td id="email_leader">ajengsriiw@gmail.com</td>
              </tr>
              <tr>
                <td class="grey">Deskripsi</td>
                <td id="description">Terpilih sebagai sekretaris bidang administrasi pada tahun pertama berorganisasi di BEM Keluarga Mahasiswa Bahasa Arab 2016</td>
              </tr>
              <tr>
                <td colspan="2"><h4>Pencapaian 2</h4></td>
              </tr>

              <tr>
                <td class="grey">Nama Pencapaian 2</td>
                <td id="achievement_2"></td>
              </tr>
              <tr>
                <td class="grey">Tanggal</td>
                <td>
                  <span id="date_from_2">
                    24 April 2017
                  </span>
                  -
                  <span id="date_end_2">
                    25 April 2018 (Durasi : 1 tahun)
                  </span>
                  <span id="duration_2">
                   (Durasi : 1 tahun)
                  </span>
                </td>
              </tr>
              <tr>
                <td class="grey">Posisi </td>
                <td id="position_name_2"></td>
              </tr>
              <tr>
                <td class="grey">Email yang punya Organisasi</td>
                <td id="email_leader_2">ajengsriiw@gmail.com</td>
              </tr>
              <tr>
                <td class="grey">Deskripsi</td>
                <td id="description_2">Terpilih sebagai sekretaris bidang administrasi pada tahun pertama berorganisasi di BEM Keluarga Mahasiswa Bahasa Arab 2016</td>
              </tr>

              <tr>
                <td class="grey">Nama Pencapaian 3 </td>
                <td id="achievement_3"></td>
              </tr>
              <tr>
                <td class="grey">Tanggal</td>
                <td>
                  <span id="date_from_3">
                    24 April 2017
                  </span>
                  -
                  <span id="date_end_3">
                    25 April 2018 (Durasi : 1 tahun)
                  </span>
                  <span id="duration_3">
                   (Durasi : 1 tahun)
                  </span>
                </td>
              </tr>
              <tr>
                <td class="grey">Posisi </td>
                <td id="position_name_3"></td>
              </tr>
              <tr>
                <td class="grey">Email yang punya Organisasi</td>
                <td id="email_leader_3">ajengsriiw@gmail.com</td>
              </tr>
              <tr>
                <td class="grey">Deskripsi</td>
                <td id="description_3">Terpilih sebagai sekretaris bidang administrasi pada tahun pertama berorganisasi di BEM Keluarga Mahasiswa Bahasa Arab 2016</td>
              </tr>
            </table>
          </div>
        </div>

        <div class="row text-center">
          <div class="col-md-12">
            <h2>Tentang Saya dan FIM </h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">

            <table class="table">
              <tr>
                <td class="grey">Mengetahui FIM dari </td>
                <td id="fim_reference">Teman</td>
              </tr>
              <tr>
                <td class="grey">Alasan Gabung FIM</td>
                <td id="why_join_fim">Sebaik-baik manusia adalah yang memberikan manfaat bagi orang lain. Saya ingin menjadi bagian dari FIM supaya keberadaan saya dapat memberikan manfaat bagi masyarakat, serta menginspirasi pemuda Indonesia untuk tidak takut untuk mengambil langkah besar yang akan mengubah Indonesia</td>
              </tr>
              <tr>
                <td class="grey">Kemampuan untuk FIM</td>
                <td id="skill_for_fim">Desain Grafis, Fotografi, Mengolah data di bagian administrasi maupun kesekretariatan</td>
              </tr>
              <tr>
                <td class="grey">Sumbangan untuk Api Ekspresi</td>
                <td id="performance_apiekspresi">Kolaborasi Musik</td>
              </tr>
            </table>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <h2 id="name_2">Name</h2>
        <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
        {{-- <button type="button" id="delete_it" class="btn btn-warning">Delete It !</button> --}}
        {{-- <button type="button" id="want_it" class="btn btn-success">I Want It !</button> --}}
        <input type="hidden" id="emailnya" name="" value="">
      </div>

      <script type="text/javascript">
      $('#delete_it').on('click', function() {
        var email = $('#emailnya').val();
        console.log(email);

          // $.ajax({
          //   url: '/seleksi-berkas/list-peserta/delete',
          //   type: 'GET',
          //   context:this,
          //   dataType: 'json',
          //   data: {email: email}
          // })
          // .done(function(data) {
          //   console.log(data);
          // });
        });
      </script>



    </div>
  </div>
</div>


  </body>
</html>
