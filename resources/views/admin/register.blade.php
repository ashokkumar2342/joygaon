<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome To Joygaon| Registration Page </title>

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
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline">

    <div class="card-header text-center" style="background-color:#508e4c;color: #fff;">

      <a href="#" class="h4"><b>JOY GAON</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="{{ route('admin.register.store') }}" method="post" no-reset="true">
        {{csrf_field()}}
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="name" placeholder="Full name" required maxlength="100" minlength="2" value="{{ old('name') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <p class="text-danger">{{ $errors->first('name') }}</p>

        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email_id" placeholder="Email" required maxlength="100" value="{{ old('email_id') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <p class="text-danger">{{ $errors->first('email_id') }}</p>

        <div class="input-group mb-3">
          <input type="text" class="form-control" name="mobile_no" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Mobile No." required maxlength="10" minlength = "10" value="{{ old('mobile_no') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <p class="text-danger">{{ $errors->first('mobile_no') }}</p>

        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" id="password" placeholder="Password" required minlength="6" maxlength="15" onchange="onChange()">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <p class="text-danger">{{ $errors->first('password') }}</p>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required minlength="6" maxlength="15" onchange="onChange()">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <p class="text-danger">{{ $errors->first('confirm_password') }}</p>

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

            <button type="submit" class="btn btn-block" style="background-color: #508e4c;color: #fff">Register</button>
          </div>
          <div class="col-12 form-group">
            <a href="{{ route('admin.login') }}" class="text-center" style="color: #508e4c">I already have a membership</a>

          </div>
        </div>
      </form>  
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('admin_asset/plugins/jQuery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('admin_asset/plugins/jquery-ui/jquery-ui.min.js') }}"></script>


<!-- Bootstrap 4 -->
<script src="{{ asset('admin_asset/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('admin_asset/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('admin_asset/dist/js/toastr.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
  function onChange() {
  const password = document.querySelector('input[name=password]');
  const confirm = document.querySelector('input[name=confirm_password]');
  if (confirm.value === password.value) {
    confirm.setCustomValidity('');
  } else {
    confirm.setCustomValidity('Passwords do not match');
  }
}
 
</script> 
{{-- <script data-ad-client="ca-pub-6986129570235357" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> --}}

</body>
</html>