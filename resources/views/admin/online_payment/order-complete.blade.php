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
      <a class="bg-success"><b>Payment Successfully</a>
      </div>  
      <div class="lockscreen-item">
      </div>
      <table class="table"> 
        <tbody>
          <tr>
            <td>Name : </td>
            <td></td>
          </tr>
          <tr>
            <td>Transaction Id : </td>
            <td>{{ $order->order_id }}</td>
          </tr>
          <tr>
            <td>Booking Id : </td>
            <td>{{ $order->booking_id }}</td>
          </tr>
          <tr>
            <td>Amount : </td>
            <td>{{ $order->amount }}</td>
          </tr>
        </tbody>
      </table> 
      <div class="text-center">
        <a href="{{ route('admin.booking.status') }}">Go to Booking History</a>
        <a href="{{ route('admin.booking.status') }}" class="btn btn-sm btn-default">Print Ticket</a>
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
 
 
</script> 
<script data-ad-client="ca-pub-6986129570235357" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

</body>
</html>