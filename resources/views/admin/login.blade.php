<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Welcome To Joygaon| Log in </title>

<!-- Google Font: Source Sans Pro -->
<meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome --> 
  <link rel="stylesheet" href="{{ asset('admin_asset/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  {{-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('admin_asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}"> 
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin_asset/dist/css/AdminLTE.min.css')}}"> 
  <!-- Google Font: Source Sans Pro -->
  {{-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> --}}
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> 
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline">
      <div class="card-header text-center" style="background-color: #508e4c;color: #fff">
        <a href="../../index2.html" class="h1"><b>JOY GAON</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p> 
        <form action="{{ route('admin.login.post') }}" method="post" class="add_form">
          {{csrf_field()}}
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="email_or_phone" placeholder="Email or phone" maxlength="100" value="{{ old('email_or_phone') }}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <p class="text-danger">{{ $errors->first('email_or_phone') }}</p>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" value="{{ old('password') }}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock text-success"></span>
              </div>
            </div>
          </div>
          <p class="text-danger">{{ $errors->first('password') }}</p>
          <div class="captcha">
            <span>{!! captcha_img('flat') !!}</span>
            <button type="button" class="btn btn-warning" onclick="refresh()"><i class="fas fa-1x fa-sync-alt" ></i></button>
          </div>
          <div class="input-group mb-3" style="margin-top: 15px">
            <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha"> 
            <div class="input-group-append">
              <div class="input-group-text">
             
              </div>
            </div>
          </div>
          <p class="text-danger">{{ $errors->first('captcha') }}</p> 
          <div class="row"> 
            <div class="col-12 form-group">
              <button type="submit" class="btn  btn-block" style="background-color: #508e4c;color: #fff">Sign In</button>
            </div> 
            <div class="col-12 form-group">
              <a href="{{ route('admin.register') }}" title="" style="color: #508e4c">Register for new membership</a><br>
              <a href="{{ route('admin.forgot.password') }}" title="" style="color: #508e4c">Forgot Password</a>
            </div>
          </div>
        </form>   
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  
  
<!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('admin_asset/plugins/jQuery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('admin_asset/plugins/jquery-ui/jquery-ui.min.js') }}"></script>


<!-- Bootstrap 4 -->
<script src="{{ asset('admin_asset/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('admin_asset/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('admin_asset/dist/js/toastr.min.js') }}"></script>
@include('admin.include.message')
<script type="text/javascript">
  function refresh(){
    $.ajax({
     type:'GET',
     url:'{{ route('admin.refresh.captcha') }}',
     success:function(data){
        $(".captcha span").html(data);
     }
  });
  }
 
</script> 
<script data-ad-client="ca-pub-6986129570235357" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

</body>
</html>