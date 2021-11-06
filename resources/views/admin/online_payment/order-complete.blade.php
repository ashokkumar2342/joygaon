 @extends('student.layout.auth')
 @push('links')
 <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> 
   <style type="text/css" media="screen">
       .fa-asterisk{
        color:red;
       }
   </style>
 @endpush
 
@section('body')
<div class="login-box"> 
     <!-- Main content -->
    <section class="content">
        <div class="box"> 
            <div class="box-body">
              <div class="login-box-body">
                <h4 class="login-box-msg bg-success text-info" style="padding-top: 15px">Payment Successfully</h4> 
                <table class="table"> 
                	<tbody>
                		<tr>
                			<td>Name</td>
                			<td>{{ $order->name }}</td>
                		</tr>
                		<tr>
                			<td>Transaction Id</td>
                			<td>{{ $order->order_id }}</td>
                		</tr>
                		<tr>
                			<td>Amount</td>
                			<td>{{ $order->amount }}</td>
                		</tr>
                	</tbody>
                </table>
                 <div class="row"> 
                   <div class="col-xs-4 pull-right">
                   	<a href="{{ route('payment.form') }}" title="">
                     <button  class="btn btn-primary">Pay Again</button>
                     </a>
                   </div>
                    <div class="col-xs-4 pull-left">
                    	<a href="http://bmiet.in" title="">
                     <button  class="btn btn-primary">Home</button>
                     </a>
                   </div> 
                 </div>
              </div> 
            </div>  
     <!-- /.content -->
   </div>

     </section>
   <!-- /.content-wrapper -->
 
</div>
@endsection
@push('scripts')
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <script>
       $( ".datepicker" ).datepicker({dateFormat:'dd-mm-yy'});
   </script>
@endpush
 