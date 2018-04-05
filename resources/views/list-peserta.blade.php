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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-12">


          <table class="hover table">
            <thead>
              <tr>
                <th>No</th>
                <th>View</th>
                <th>Jumlah Kosong</th>
                <th>Nama</th>
                <th>Nomor Hp</th>
                <th>E-Mail</th>
                <th>Keputusan</th>
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
                  <td>{{$member->name}}</td>
                  <td>{{$member->phone}}</td>
                  <td>{{$member->email}}</td>
                  <td>
                    <span class="btn btn-warning tolak">Tolak / Hapus</span>
                  </td>
                </tr>

                <script type="text/javascript">
                  $(document).ready(function() {
                    $('.tolak').on('click', function() {
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
                    });

                  });
                </script>

              @endforeach


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
            <img style="width:250px" class="img img-responsive" src="https://opensource.google.com/assets/static/images/home/blog/blog_image_1.jpg" alt="">
          </div>
          <div class="col-md-8">
            <h2>Bagus Dwi Utama</h2>
            <h5>Bogor</h5>
            <h5>Institut Pertanian Bogor</h5>
          </div>
        </div>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


  </body>
</html>
