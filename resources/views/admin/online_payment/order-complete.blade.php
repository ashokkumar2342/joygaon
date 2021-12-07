<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AdminLTE 3 | Log in (v2)</title>

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
  <div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
      <a><b><H1 style="color: #31ba32;font-size:60px">THANK YOU! <i class="fa fa-check" aria-hidden="true"></i></H1></a>
      <a><b><H5 style="color: #939496;font-size:15px">Payment Completed Successfully!</H5></a>
      </div>  
      <div class="lockscreen-item">
      </div>
      <table class="table"> 
        <tbody>
          {{-- <tr>
            <td>Name : </td>
            <td>{{ $user_name }}</td>
          </tr>
          <tr>
            <td>Order Id : </td>
            <td>{{ $order_id }}</td>
          </tr>
          
          <tr>
            <td>Ticket No. : </td>
            <td>{{ $ticket_no }}</td>
          </tr> --}}
        </tbody>
      </table> 
      <div class="text-center">
        <a href="{{ route('admin.booking.status') }}">Go to Booking History</a>
        <a href="{{ route('admin.download.ticket',{{-- Crypt::encrypt($order_id) --}}) }}" target="blank" class="btn btn-sm btn-warning">Print Ticket</a>
      </div>
      <div class="text-center">
        <a id="btn_book" href="{{ route('admin.booking')}}"  class="btn btn" style="margin:10px;width:200px;height:40px;background-color:#fbf104;border: solid 1px;">Book Again</a>
      </div> 
    </div> 
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
 $('#btn_book').mouseover(function(){
    $('#btn_book').css("background-color", "#31ba32").css("color", "#fff");
  });
  $('#btn_book').mouseout(function(){
    $('#btn_book').css("background-color", "#fbf104").css("color", "black");;
  });
 
</script> 
<script data-ad-client="ca-pub-6986129570235357" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>
</html>