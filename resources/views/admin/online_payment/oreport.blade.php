@extends('admin.layout.base')
@section('body')
@push('links') 
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <style type="text/css">
      .radio label {
    padding-right: 20px;
}
  </style>
@endpush
<section class="content-header"> 
Payment Details
    <ol class="breadcrumb">
     <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>        
     </ol>
</section>
    <section class="content">
      <div class="box">       
      <table id="dataTable" class="table table-bordered table-striped table-hover ">
          <thead>
            <tr>               
              <th>Date</th>                          
              <th>Roll</th>                          
              <th>Name</th>
              <th>Branch</th>
              <th>Semester</th>
              <th>Order Id</th>
              
              <th>Paymentmode</th>
              <th>Bankname</th>
              <th>Type</th>
              <th>Status</th>
              
              <th>Amount</th>
            </tr>
          </thead>            
          <tbody>          
            @foreach($onlinePayments as $onlinePayment)
            <tr>
              <td>{{ date('d-m-Y',strtotime($onlinePayment->created_at)) }}</td>
              <td>{{ $onlinePayment->student->roll or '' }}</td>
              <td>{{ $onlinePayment->name or '' }}</td>
              <td>{{ $onlinePayment->branch }}</td>
              <td>{{ $onlinePayment->semester }}</td>
              <td>{{ $onlinePayment->order_id }}</td>
              
              <td>{{ $onlinePayment->paymentmode }}</td>
              <td>{{ $onlinePayment->bankname }}</td>
              <td>{{ $onlinePayment->type==1?'New Student':'Old Student' }}</td>
              <td>
              	@if ($onlinePayment->status==1)
              		 <span class="btn btn-success btn-xs">Success</span>
              	@else
              	<span class="btn btn-danger btn-xs">Failed</span>		 
              	@endif
               
              	</td>
              <td>{{ $onlinePayment->amount }}</td>
           
            </tr>            
            @endforeach
          </tbody>                 
        </table>
      </div>
        <!-- /.box -->
    
    </section>
    <!-- /.content -->    
@endsection
@push('links')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.1/css/buttons.dataTables.min.css">
@endpush
 @push('scripts')
 <script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
 <script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
 <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
 <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
 <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
 <script type="text/javascript" src="////cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
 <script type="text/javascript" src="//cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js"></script>
 
 <script type="text/javascript">
 /* Custom filtering function which will search data in column four between two values */

 
  $(document).ready(function() {
    var table = $('#dataTable').DataTable( { 
         
          responsive: true,
 
             "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],  

           dom: 'Bfrtip',

        buttons:
         [
           
            'excelHtml5', 'pageLength',             
        ] 
    });
  });
 </script>
    
 </script>
 
@endpush