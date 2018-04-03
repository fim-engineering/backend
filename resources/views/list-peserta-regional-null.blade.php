<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <title>FIM API</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <!-- Styles -->
        {{-- <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style> --}}
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            {{-- @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif --}}

            <div class="content">

              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group" style="margin-top:80px">
                      <label for="">Sebelumnya Isi Nama Kamu di sini untuk merekam riwayat</label>
                      <input type="text" class="form-control" id="nama-pengirim" placeholder="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Pesan</label>
                      <textarea name="name" class="form-control" rows="8" id="isi-pesan" cols="40">Hai, Pemuda Indonesia, Kami mendapati form pendaftaran Portal Forum Indonesia Muda kamu belum mengisi regional mana yang ingin kamu pilih untuk kamu berkarya. Kami membuka kesempatan bagi khusus bagi kamu yang menerima pesan ini untuk memperbaikinya. Segera perbaiki dan submit kembali.  </textarea>

                    </div>
                  </div>
                </div>
                {{-- <script type="text/javascript">
                  $(document).ready(function() {
                    var =$('#nama-pengirim').val();
                    if (true) {

                    }
                  });
                </script> --}}

                <script type="text/javascript">
                  $(document).ready(function() {

                    $('#nama-pengirim').on('keyup', function() {
                      var nama = $(this).val();

                      if (nama !== "") {
                        $('.sendnotification').show();
                      }else {
                        $('.sendnotification').hide();
                      }
                    });
                  });
                </script>

                <div class="row">
                  <div class="col-md-12">

                    <table class="table">
                      <thead>
                        <th>No</th>
                        <th>Data Kosong</th>
                        <th>Action</th>
                        <th>Status</th>
                        <th>Nama</th>
                        <th>Phone</th>
                        <th>Email</th>


                        <th>Send By</th>
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

                          {{-- @if (count($juml_null)) --}}

                            <tr>
                              <td>{{$i++}}</td>
                              <td>{{$juml_null}}</td>
                              <td>
                                <a href="#absc" class="btn btn-success sendnotification" style="display:none" >Open User Access</a>
                                <input type="hidden" class="email" name="" value="{{$member->email}}">
                              </td>
                              <td>
                                @if ($member->final_submit == 1)
                                  <span class="btn btn-info closedtext" >Closed</span>
                                @else
                                  <span class="btn btn-danger">Opened</span>
                                @endif
                              </td>
                              <script type="text/javascript">
                              $(document).ready(function() {
                                $('.sendnotification').on('click', function() {
                                  var name = $('#nama-pengirim').val();
                                  var email = $(this).parent().find('.email').val();
                                  var isipesan = $('#isi-pesan').val();

                                  $.ajax({
                                    url: '/admin/add-record-broadcast',
                                    type: 'GET',
                                    context:this,
                                    dataType: 'json',
                                    data: {name: name,
                                      email: email,
                                      message: isipesan,
                                    }
                                  })
                                  .done(function(data) {
                                    if (data.message == "Berhasil") {
                                      $(this).parent().parent().find('.closedtext').text('Opened').addClass('btn-danger').removeClass('btn-info');


                                      $(this).text('Send Notification !').addClass('btn-warning').removeClass('btn-success');
                                      $(this).attr('href', data.link).attr('target','_blank');

                                      $('.btn-warning').on('click', function() {
                                        $(this).parent().parent().find('.comt-user').text(data.desc);
                                      });
                                    }

                                  })
                                  .fail(function() {
                                    console.log("error");
                                  })
                                  .always(function() {
                                    console.log("complete");
                                  });

                                });
                              });
                            </script>

                            <td>{{$member->name}}</td>
                            <td>{{$member->phone}}</td>
                            <td>{{$member->email}}</td>


                            <td class="comt-user">
                              {{$member->comt}}
                            </td>
                          </tr>
                          {{-- @endif --}}
                        @endforeach

                        @php
                          dd($juml_null);
                        @endphp

                      </tbody>
                    </table>
                  </div>

                  {{ $members->links() }}
                </div>
              </div>

              {{-- @auth
                  <a href="{{ url('/home') }}">Home</a>

                  <a href="{{ route('login') }}">Login</a>
                  <a href="{{ route('register') }}">Register</a>
              @endauth --}}



                {{-- <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div> --}}
            </div>
        </div>
    </body>
</html>
