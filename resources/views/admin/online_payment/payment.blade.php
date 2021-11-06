@extends('admin.layout.base')
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
                <h2 class="login-box-msg">Online Pay</h2> 
                <form action="{{ route('payment.store') }}" method="post">
                  {{ csrf_field() }}
                  <div class="form-group has-feedback">
                    <select name="type" class="form-control" onchange="this.value==1?$('#roll').hide():$('#roll').show()" required> 
                      <option  selected disabled="">Select Type</option> 
                      <option value="1">New Student</option> 
                      <option value="2">Old Student</option> 
                    </select>
                     
                    <p class="text-danger">{{ $errors->first('type') }}</p>
                  </div>
                  <div class="form-group has-feedback">
                    {!! Form::text('name', '', ['class'=>'form-control', 'placeholder'=>'Name','required']) !!} 
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                  </div>
                  <div class="form-group has-feedback" >

                    <input type="text" class="form-control" name="roll" id="roll" placeholder="College Roll No(last 3 digits)">
                     
                    <p class="text-danger">{{ $errors->first('roll') }}</p>
                  </div>
                  <div class="form-group has-feedback">
                    <select name="branch" class="form-control" required> 
                      <option  disabled selected>Select Branch</option> 
                      <option value="BBA">BBA</option> 
                      <option value="BBA">MBA</option> 
                      <option value="CSE">CSE</option> 
                      <option value="ECE">ECE</option> 
                      <option value="ME">ME</option> 
                      <option value="CIVIL">CIVIL</option> 
                      <option value="EEE">EEE</option> 
                      <option value="IOT">IOT</option> 
                      <option value="AI">AI</option> 
                    </select>
                     
                    <p class="text-danger">{{ $errors->first('branch') }}</p>
                  </div> 
                  <div class="form-group has-feedback">
                    <select name="semester" class="form-control" required> 
                      <option  disabled selected>Select Semester</option> 
                      <option value="1">Semester 1</option> 
                      <option value="2">Semester 2</option> 
                      <option value="3">Semester 3</option> 
                      <option value="4">Semester 4</option> 
                      <option value="5">Semester 5</option> 
                      <option value="6">Semester 6</option> 
                      <option value="7">Semester 7</option> 
                      <option value="8">Semester 8</option> 
                    </select>
                     
                    <p class="text-danger">{{ $errors->first('branch') }}</p>
                  </div>
                  <div class="form-group has-feedback">
                    {!! Form::text('amount', '', ['class'=>'form-control', 'placeholder'=>'Amount','required']) !!} 
                    <p class="text-danger">{{ $errors->first('amount') }}</p>
                  </div>
                  <div class="row"> 
                    <div class="col-xs-4 pull-right">
                      <button type="submit" class="btn btn-primary btn-block btn-flat">Pay</button>
                    </div> 
                  </div>
                </form> 
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
