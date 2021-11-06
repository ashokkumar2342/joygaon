@extends('admin.layout.base')
@section('body')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Booking</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right"> 
                </ol>
            </div>
        </div> 
        <div class="card card-info"> 
            <div class="card-body">
                <form action="{{ route('payment.store') }}" method="post"  >
                    {{ csrf_field() }}
                    <div class="row"> 
                        <div class="col-lg-6 form-group"> 
                            <label for="exampleInputEmail1">Booking Type</label>
                            <span class="fa fa-asterisk"></span>
                            <select class="form-control" name="booking_type">
                            @foreach ($bookingTypes as $bookingType)
                                <option value="{{$bookingType->id}}">{{$bookingType->code}}-{{$bookingType->name}}</option>
                            @endforeach 
                             </select>                    
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>Booking Date</label>
                            <span class="fa fa-asterisk"></span> 
                            <input type="date" name="booking_date" class="form-control" id="exampleInputEmail1" maxlength="50" min="{{ date('Y-m-d',strtotime(date('d-m-Y'))) }}"> 
                        </div> 
                        <div class="col-lg-4 form-group">
                            <label>Adults</label>
                            <span class="fa fa-asterisk"></span> 
                            <input type="text" name="adults" class="form-control" id="exampleInputEmail1" maxlength="50"> 
                        </div>
                        <div class="col-lg-4 form-group">
                            <label>Children</label>
                            <span class="fa fa-asterisk"></span> 
                            <input type="text" name="children" class="form-control" id="exampleInputEmail1" maxlength="50"> 
                        </div>
                        <div class="col-lg-4 form-group">
                            <label>Senior Citizens</label>
                            <span class="fa fa-asterisk"></span> 
                            <input type="text" name="senior_citizens" class="form-control" id="exampleInputEmail1" maxlength="50"> 
                        </div> 
                        <div class="col-lg-3 form-group">
                            <label>Head Name</label> 
                            <span class="fa fa-asterisk"></span>
                            <input type="text" name="head_name" class="form-control" id="exampleInputEmail1" maxlength="50"> 
                        </div>
                        <div class="col-lg-3 form-group">
                            <label>Team Leader Name</label>
                            <span class="fa fa-asterisk"></span> 
                            <input type="text" name="team_leader_name" class="form-control" id="exampleInputEmail1" maxlength="50"> 
                        </div>
                        <div class="col-lg-3 form-group">
                            <label>Head Mobile No.</label>
                            <span class="fa fa-asterisk"></span> 
                            <input type="text" name="head_mobile_no" class="form-control" id="exampleInputEmail1" maxlength="50"> 
                        </div>
                        <div class="col-lg-3 form-group">
                            <label>Head Email ID</label> 
                            <input type="text" name="head_email_id" class="form-control" id="exampleInputEmail1" maxlength="50"> 
                        </div> 
                    </div>   
                    <div class="box-footer text-center" style="margin-top: 30px">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div> 
              </form>  
            </div> 
        </div>
    </section>
    @endsection 

