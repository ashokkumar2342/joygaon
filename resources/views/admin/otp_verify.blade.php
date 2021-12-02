<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome To Joygaon| Verification</title>

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
  <div class="login-logo">
    <a href="#"><b>Enter Verification Code</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
        @if (@$email_rs[0]->status !=1)
        <p class="login-box-msg">Check Your Email <b>{{$email_id}}</b> For The Verification Code</p>
        <form action="{{ route('admin.otp.verify.store',Crypt::encrypt(1)) }}" method="post">
          {{csrf_field()}}
          <div class="row">
            <div class="col-lg-12 form-group">
              <input type="text" name="email_otp" class="form-control" placeholder="Email Verification Code" required minlength="6" maxlength="6" onkeypress='return event.charCode >= 48 && event.charCode <= 57'> 
            </div>
            <div class="col-lg-12 form-group">
              <input type="hidden" name="user_id" class="form-control hidden" value="{{@$user_id}}"> 
            </div>
            <div class="col-lg-6 form-group">
              <input type="submit"  class="form-control btn btn-info" value="Verify"> 
            </div>
            <div class="col-lg-6 form-group">
              <a href="{{ route('admin.otp.resend',[@$user_id,1]) }}" class="btn  btn-warning">Resend Code</a>
            </div> 
          </div>
        </form> 
        @endif
        @if (@$mobile_rs[0]->status !=1)
        <p class="login-box-msg">Check Your Mobile <b>****{{substr($mobile_no, 6)}}</b> For The Verification Code</p>
        <form action="{{ route('admin.otp.verify.store',Crypt::encrypt(2)) }}" method="post">
          {{csrf_field()}}
          <div class="row">
            <div class="col-lg-12 form-group">
              <input type="hidden" name="user_id" class="form-control hidden" value="{{@$user_id}}"> 
            </div>
            <div class="col-lg-12 form-group">
              <input type="text" name="mobile_otp" class="form-control" placeholder="Mobile Verification Code"  required minlength="6" maxlength="6" onkeypress='return event.charCode >= 48 && event.charCode <= 57'> 
            </div>
            <div class="col-lg-6 form-group">
              <input type="submit"  class="form-control btn btn-info" value="Verify"> 
            </div>
            <div class="col-lg-6 form-group">
              <a href="{{ route('admin.otp.resend',[@$user_id,2]) }}" class="btn  btn-warning">Resend Code</a>
            </div> 
          </div>
        </form> 
        @endif 
    </div> 
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
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
  
 
</script> 
{{-- <script data-ad-client="ca-pub-6986129570235357" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> --}}

</body>
</html>
