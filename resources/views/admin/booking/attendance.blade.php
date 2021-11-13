@extends('admin.layout.base')
@section('body')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Attendance</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right"> 
                </ol>
            </div>
        </div> 
        <div class="card card-info"> 
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4" style="margin-left: 20px">
                     <label>Ticket No.</label>
                       <input type="text"  class="form-control"  autocomplete="off" name="ticket_no" id="ticket_no" autofocus onkeyup="barcodeAttendance(this)" > 
                    </div>
                </div> 
                <div id="div_show" style="margin-top: 40px">
                           
                </div>
            </div> 
        </div>
    </section>
@endsection
@push('links') 
@endpush
 @push('scripts') 
<script>
  function barcodeAttendance(obj) { 
   
    if (obj.value.length==2) {  
        callAjax(this,'{{ route('admin.attendance.barcode') }}'+'?ticket_no='+$('#ticket_no').val(),'div_show'); 
        document.getElementById("ticket_no").value= '';
    }  
  } 
 </script> 
@endpush 

