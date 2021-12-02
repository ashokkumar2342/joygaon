@extends('admin.layout.base')
@section('body')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Check In</h3>
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
                       <input type="text"  class="form-control" success-popup="true" autocomplete="off" name="ticket_no" id="ticket_no" autofocus onkeyup="barcodeAttendance(this)" maxlength="5"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'> 
                    </div>
                </div>
                <form action="{{ route('admin.attendance.store') }}" method="post" class="add_form">
                {{csrf_field()}} 
                <div id="div_show" style="margin-top: 40px">
                           
                </div>
                </form>    
            </div> 
        </div>
    </section>
@endsection
@push('links') 
@endpush
 @push('scripts') 
<script>
  function barcodeAttendance(obj) { 
   
    if (obj.value.length==5) {  
        callAjax(this,'{{ route('admin.attendance.barcode') }}'+'?ticket_no='+$('#ticket_no').val(),'div_show'); 
        document.getElementById("ticket_no").value= '';
    } 

    const adults = document.querySelector('input[name=adults_count]');
        const children = document.querySelector('input[name=children_count]');
        if ((children.value == 0 ) && (adults.value ==0)){
        children.setCustomValidity('Adults And Children not be 0');
        } else {
        children.setCustomValidity('');
        } 
  } 
 </script> 
@endpush 

