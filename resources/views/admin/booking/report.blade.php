@extends('admin.layout.base')
@push('links')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css">    
@endpush
@section('body')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Report</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right"> 
                </ol>
            </div>
        </div>
        <div class="card card-info"> 
            <div class="card-body">
                <form action="{{ route('admin.report.post') }}" method="post" class="add_form" success-content-id="user_report_excel_datatable" no-reset="true" data-table-without-pagination="report_table">
                {{ csrf_field() }}
                <div class="row">  
                    <div class="col-lg-6">
                        <div class="form-group">
                          <label>From Date</label>
                          <input type="date"  name="from_date" class="form-control" required> 
                        </div> 
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                          <label>To Date</label>
                          <input type="date"  name="to_date" class="form-control" required> 
                        </div> 
                    </div> 
                    <div class="col-lg-12 form-group"> 
                        <input type="submit" class="form-control btn btn-primary" value="Show">
                    </div>
                </div> 
                </form> 
                <div class="col-lg-12" id="user_report_excel_datatable">
                    
                </div>
            </div> 
        </div>
     </div>
</section>
@endsection
@push('scripts')
<script type="text/javascript" src="//code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>

<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.html5.min.js"></script>
<script type='text/javascript' src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]

    } );
} );
   </script>
</script> 
@endpush

