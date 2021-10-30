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
                <form action="{{ route('admin.add.new.user.store') }}" method="post" class="add_form" >
                    {{ csrf_field() }}
                    <div class="row"> 
                        <div class="col-lg-4 form-group"> 
                            <label for="exampleInputEmail1">Booking Type</label>
                            <span class="fa fa-asterisk"></span>
                            <select class="form-control" name="booking_type"> 
                             </select>                    
                        </div>
                        <div class="col-lg-4 form-group">
                            <label>Total Person</label>
                            <span class="fa fa-asterisk"></span> 
                            <input type="text" name="total_person" class="form-control" id="exampleInputEmail1" placeholder="Enter Email" maxlength="50"> 
                        </div>
                        <div class="col-lg-4 form-group">
                            <label>Adults</label>
                            <span class="fa fa-asterisk"></span> 
                            <input type="text" name="adults" class="form-control" id="exampleInputEmail1" placeholder="Enter Email" maxlength="50"> 
                        </div>
                        <div class="col-lg-4 form-group">
                            <label>Children</label>
                            <span class="fa fa-asterisk"></span> 
                            <input type="text" name="children" class="form-control" id="exampleInputEmail1" placeholder="Enter Email" maxlength="50"> 
                        </div>
                        <div class="col-lg-4 form-group">
                            <label>Senior Citizens</label>
                            <span class="fa fa-asterisk"></span> 
                            <input type="text" name="senior_citizens" class="form-control" id="exampleInputEmail1" placeholder="Enter Email" maxlength="50"> 
                        </div>
                        <div class="col-lg-4 form-group">
                            <label>Total Person</label>
                            <span class="fa fa-asterisk"></span> 
                            <input type="text" name="total_person" class="form-control" id="exampleInputEmail1" placeholder="Enter Email" maxlength="50"> 
                        </div>
                        <div class="col-lg-4 form-group">
                            <label>Booking Date</label>
                            <span class="fa fa-asterisk"></span> 
                            <input type="date" name="booking_date" class="form-control" id="exampleInputEmail1" placeholder="Enter Email" maxlength="50"> 
                        </div>
                        <div class="col-lg-4 form-group">
                            <label>Transaction No.</label>
                            <span class="fa fa-asterisk"></span> 
                            <input type="text" name="transaction_no" class="form-control" id="exampleInputEmail1" placeholder="Enter Email" maxlength="50"> 
                        </div>
                        <div class="col-lg-4 form-group">
                            <label>Transaction Date</label>
                            <span class="fa fa-asterisk"></span> 
                            <input type="date" name="transaction_date" class="form-control" id="exampleInputEmail1" placeholder="Enter Email" maxlength="50"> 
                        </div>
                        <div class="col-lg-4 form-group">
                            <label>Amount</label>
                            <span class="fa fa-asterisk"></span> 
                            <input type="text" name="amount" class="form-control" id="exampleInputEmail1" placeholder="Enter Email" maxlength="50"> 
                        </div>
                        <div class="col-lg-4 form-group">
                            <label>Payment Mode</label>
                            <span class="fa fa-asterisk"></span> 
                            <input type="text" name="payment_mode" class="form-control" id="exampleInputEmail1" placeholder="Enter Email" maxlength="50"> 
                        </div>
                        <div class="col-lg-4 form-group">
                            <label>Remarks</label> 
                            <input type="text" name="payment_mode" class="form-control" id="exampleInputEmail1" placeholder="Enter Email" maxlength="50"> 
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

