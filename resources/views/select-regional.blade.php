<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Seleksi Berkas</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

  </head>
  <body>
    <form class="" action="index.html" method="post">
      {{ csrf_field() }}
      <div class="container">
        <div class="warper" style="margin-top:100px">
          <div class="row">
            <h2>Pilih Regional</h2>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for=""></label>
                <select class="form-control form-control-lg form-block" name="regional">
                  @foreach ($regionals as $regional)
                    <option value="{{$regional->regional_name}}">{{$regional->regional_name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <input type="password" class="form-control form-control-lg form-block" id="" placeholder="Password">
              </div>

              <button type="button" class="btn btn-danger btn-default btn-lg btn-block">
                Submit
              </button>
            </div>
          </div>
        </div>
      </div>
    </form>

  </body>
</html>
