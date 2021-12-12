
@include('front.header')
<style>
    label {
    color: #f9f3f3;
    display: block;
    font-weight: 400;
    margin-bottom: 10px;
}
</style>
<!--Header Wrap End-->
<!-- About Start here -->
<section class="about about-two" style="background: #508e4c;color: #fff;">
    <div class="container"> 
                <form action="{{ route('front.booking.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="row"> 
                        <div class="col-lg-6 form-group"> 
                            <label for="exampleInputEmail1">Booking Type</label> 
                            <select class="form-control" name="booking_type" id="booking_type" required onchange="amontAdd()">
                            <option selected disabled>Select Booking Type</option>
                            @foreach ($bookingTypes as $bookingType)
                                <option value="{{$bookingType->id}}" @if (old('booking_type')==$bookingType->id) selected="selected" @endif>{{$bookingType->code}}-{{$bookingType->name}}</option>
                            @endforeach 
                             </select>                    
                        <p class="text-danger">{{ $errors->first('booking_type') }}</p>
                        </div>
                        <div class="col-lg-6">
                            <label>Trip Date</label> 
                            <input type="date" name="trip_date" class="form-control"  min="{{ date('Y-m-d',strtotime(date('d-m-Y'))) }}" required value="{{ old('trip_date') }}"> 
                        <p class="text-danger">{{ $errors->first('trip_date') }}</p> 
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-lg-6 form-group">
                            <label>School/Company/Person Name</label>
                            <input type="text" name="school_Company_name" class="form-control"   required maxlength="100" value="{{ old('school_Company_name') }}">
                        <p class="text-danger">{{ $errors->first('school_Company_name') }}</p> 
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>Address/City</label>
                            <input type="text" name="school_Company_city" class="form-control"  required maxlength="100" value="{{ old('school_Company_city') }}">
                        <p class="text-danger">{{ $errors->first('school_Company_city') }}</p>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-lg-4 form-group">
                            <label>Contact Person Name</label> 
                            <input  name="contact_person_name" class="form-control"  maxlength="50" required value="{{ old('contact_person_name') }}"> 
                        <p class="text-danger">{{ $errors->first('team_leader_name') }}</p>
                        </div>
                        <div class="col-lg-4 form-group">
                            <label>Mobile No.</label>
                            <input  name="contact_mobile_no" class="form-control" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required value="{{ old('contact_mobile_no') }}"> 
                        <p class="text-danger">{{ $errors->first('contact_mobile_no') }}</p> 
                        </div>
                        <div class="col-lg-4 form-group">
                            <label>Email ID.</label> 
                            <input  name="email_id" class="form-control" required value="{{ old('email_id') }}">
                            <p class="text-danger">{{ $errors->first('email_id') }}</p>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-lg-4 form-group">
                            <label>Adults (Above 10 Years)</label> 
                            <input type="text" name="adults" class="form-control" id="adult_div" maxlength="3" onkeyup="amontAdd()" value="0" required onkeypress='return event.charCode >= 48 && event.charCode <= 57'> 
                        <p class="text-danger">{{ $errors->first('adults') }}</p> 
                        </div>
                        <div class="col-lg-4 form-group">
                            <label>Children (5-10 Years)</label> 
                            <input type="text" name="children" class="form-control" id="children_div" maxlength="3" onkeyup="amontAdd()" value="0" onkeypress='return event.charCode >= 48 && event.charCode <= 57'> 
                        <p class="text-danger">{{ $errors->first('children') }}</p>
                        </div>
                        <div class="col-lg-4 form-group">
                            <label>Total Amount</label> 
                            <input type="text" name="total_amount" class="form-control"  readonly id="total_amount_show" value="0">
                        </div> 
                    </div>
                    <div class="row"> 
                        <div class="col-lg-4 form-group">
                            <label>Reddem a gift card or promo code</label> 
                            <input type="text" name="code" class="form-control" maxlength="8"> 
                        <p class="text-danger">{{ $errors->first('adults') }}</p> 
                        </div>
                        <div class="col-lg-2 form-group" style="margin-top: 35px;">
                            <a href="" style="color:blue;margin-top: 30px;">Verify Code</a>
                        </div>
                        <div class="col-lg-4 form-group" style="margin-top: 35px;">
                            <input type="submit" class=" btn btn-info" value="Booking" style="width: 250px">
                        </div>

                    </div>
                           
                    </div>
                     
              </form>  
           
        </div><!-- row -->
    </div><!-- container -->
</section>

   <script>
    var totalPoints = 0;
    var brate_ad = [];
    var brate_ch = [];
    var counter = 1;
    @foreach ($bookingTypes as $brate)
        brate_ad[counter] = {{$brate->ad_amount}};
        brate_ch[counter] = {{$brate->ch_amount}};
        counter = counter + 1;    
    @endforeach
    function amontAdd() {
        booking_type = $('#booking_type').val() ;
        if(booking_type==null){
           alert('Please select booking type')
           return false;
        }

        adult_div = parseInt($('#adult_div').val());
        children_div = parseInt($('#children_div').val());
        if(isNaN(adult_div)){
           adult_div=0; 
        }
        if(isNaN(children_div)){
           children_div=0; 
        }
        adult_div = adult_div * brate_ad[booking_type];
        children_div = children_div * brate_ch[booking_type];
        totalPoints = adult_div+children_div; 
        $('#total_amount_show').val(totalPoints);
        $('#total_amount_hidden').val(totalPoints);

        const adults = document.querySelector('input[name=adults]');
        const children = document.querySelector('input[name=children]');
        if ((children.value == 0 ) && (adults.value ==0)){
        children.setCustomValidity('Adults And Children not be 0');
        } else {
        children.setCustomValidity('');
        }     
    }
    
   
        
  
   </script>

@include('front.footer')
<!--Footer Wrap End-->
<!--Back to Top Wrap Start-->


