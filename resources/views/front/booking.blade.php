
@include('front.header')
<!--Header Wrap End-->
<!-- About Start here -->
<section class="about about-two">
    <div class="container">
        <div class="row">
                <form action="{{ route('admin.booking.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="row"> 
                        <div class="col-lg-6 form-group"> 
                            <label for="exampleInputEmail1">Booking Type</label>

                            <select class="form-control" name="booking_type" id="booking_type" required onchange="amontAdd()">
                            <option selected disabled>Select Booking Type</option>
                            {{-- @foreach ($bookingTypes as $bookingType)
                                <option value="{{$bookingType->id}}">{{$bookingType->code}}-{{$bookingType->name}}</option>
                            @endforeach  --}}
                             </select>                    
                        <p class="text-danger">{{ $errors->first('booking_type') }}</p>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>Trip Date</label> 
                            <input type="date" name="trip_date" class="form-control"  min="{{ date('Y-m-d',strtotime(date('d-m-Y'))) }}" required> 
                        <p class="text-danger">{{ $errors->first('trip_date') }}</p> 
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>School/Company/Person Name</label>
                            <span class="fa fa-asterisk"></span>
                            <textarea name="school_Company_name" class="form-control section"   required maxlength="100" style="height: 50px"></textarea> 
                        <p class="text-danger">{{ $errors->first('school_Company_name') }}</p> 
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>Address/City</label>
                            <span class="fa fa-asterisk"></span>
                            <textarea name="school_Company_city" class="form-control section"  required maxlength="100" style="height: 50px"></textarea> 
                        <p class="text-danger">{{ $errors->first('school_Company_city') }}</p>
                        </div>
                        <div class="col-lg-4 form-group">
                            <label>Adults</label>
                            <span class="fa fa-asterisk"></span> 
                            <input type="text" name="adults" class="form-control section" id="adult_div" maxlength="3" onkeyup="amontAdd()" value="0" required  onkeypress='return event.charCode >= 48 && event.charCode <= 57'> 
                        <p class="text-danger">{{ $errors->first('adults') }}</p> 
                        </div>
                        <div class="col-lg-4 form-group">
                            <label>Children</label>
                            <span class="fa fa-asterisk"></span> 
                            <input type="text" name="children" class="form-control section" id="children_div" maxlength="3" onkeyup="amontAdd()" value="0" onkeypress='return event.charCode >= 48 && event.charCode <= 57'> 
                        <p class="text-danger">{{ $errors->first('children') }}</p>
                        </div>
                        <div class="col-lg-4 form-group" style="margin-top: 30px"> 
                            <div class="card bg-gray"> 
                              <div class="form-group clearfix">
                                <div class="icheck-primary d-inline"> 
                                  <input type="text" name="total_amount"  id="total_amount_hidden">
                                  <span style="margin: 15px"> Total Amount : <b><span id="total_amount_show"> 0</span></b></span>
                                </div> 
                              </div>
                            </div> 
                        </div>
                        <div class="col-lg-4 form-group">
                            <label>Contact Person Name</label>
                            <span class="fa fa-asterisk"></span> 
                            <input type="text" name="contact_person_name" class="form-control"  maxlength="50" required> 
                        <p class="text-danger">{{ $errors->first('team_leader_name') }}</p>
                        </div>
                        <div class="col-lg-4 form-group">
                            <label>Mobile No.</label>
                            <span class="fa fa-asterisk"></span> 
                            <input type="text" name="contact_mobile_no" class="form-control" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required > 
                        <p class="text-danger">{{ $errors->first('contact_mobile_no') }}</p> 
                        </div>
                        <div class="col-lg-4 form-group">
                            <label>Email ID.</label> 
                            <input type="email" name="email_id" class="form-control" >
                        </div>
                        
                        <div class="col-lg-12 form-group text-center" style="margin-top: 30px">
                          <input type="submit" class=" btn btn-info" value="Booking" style="width: 250px">
                        </div>   
                    </div>
                     
              </form>  
           
        </div><!-- row -->
    </div><!-- container -->
</section><!-- about -->
<!-- About End here --> 
<!--Footer Wrap Start-->
@include('front.footer')
<!--Footer Wrap End-->
<!--Back to Top Wrap Start-->
