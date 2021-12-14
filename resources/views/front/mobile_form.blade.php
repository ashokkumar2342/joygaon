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
    <a href="#"><b>Get Verification Code</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body"> 
        <form action="{{ route('front.mobile.verify') }}" method="post">
          {{csrf_field()}}
          <div class="row">
            <div class="col-lg-12 form-group">
              <input type="text" name="mobile_no" class="form-control" placeholder="Enter Mobile No."  required minlength="10" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'> 
            </div>
            <div class="col-lg-12 form-group">
              <input type="submit"  class="form-control btn" id="get_btn" value="Get Verification Code" style="background-color:#80cd33;color:#fff"> 
            </div>
           
          </div>
        </form> 
       
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
  
 $('#get_btn').mouseover(function(){
        $('#get_btn').css("background-color", "#5a9023");
      });
      $('#get_btn').mouseout(function(){
        $('#get_btn').css("background-color", "#80cd33");
      });
</script> 
{{-- <script data-ad-client="ca-pub-6986129570235357" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> --}}

</body>
</html>
