@extends('admin.layout.base')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css">
@section('body')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Payment History</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right"> 
                </ol>
            </div>
        </div> 
        <div class="card card-info"> 
            <div class="card-body">
                <form action="{{ route('admin.payment.history.show') }}" method="post" class="add_form" no-reset="true" success-content-id="report_table" export-table-without-pagination="payment_his_table">
                {{ csrf_field() }}
                <div class="row">  
                    <div class="col-lg-6">
                        <div class="form-group">
                          <label>Date Range (MM/DD/YYYY - MM/DD/YYYY)</label>
                          <input type="text" id="reportrange" name="date_range" style=";background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%"> 
                        </div> 
                    </div> 
                    <div class="col-lg-6 form-group"> 
                        <input type="submit" class="form-control btn btn-primary" value="Show" style="margin-top: 30px">
                    </div>
                </div> 
                </form> 
                <div id="report_table">
                    
                </div>
             </div>
         </div>
     </div>
</section>
@endsection
@push('scripts')
<script type="text/javascript"> 
  
 $(function() {

     var start = moment().subtract(6, 'days');
     var end = moment();

     function cb(start, end) {
         $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
     }

     $('#reportrange').daterangepicker({
         startDate: start,
         endDate: end,
         ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
         }
     }, cb);

     cb(start, end);

 });
 
</script> 

<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script> 
<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.html5.min.js"></script>
<script type='text/javascript' src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
@endpush

