
@include('front.header')
<style>
    label {
    color: #fff;
    display: block;
    font-weight: 400;
    margin-bottom: 10px;
}
 #message{
  position: relative;
  top: 10px;
  color:green;
}
#err{
  position: relative;
  top: 10px;
  color:red;
}
#bac{
    background-image: url('{{asset('front_asset/images/banner2.jpg')}}');
    height: 650px;
}
 .fa-asterisk {
     color: red;
     font-size:7px; 
     vertical-align: super;
   }

</style>
<!--Header Wrap End-->
<!-- About Start here -->
<section class="about about-two" id="bac">
    <div class="container"> 
                <form action="{{ route('front.booking.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                    <input type="hidden" name="type" class="form-control hidden" value="1"> 
                        <div class="col-lg-8 form-group"> 
                            <label for="exampleInputEmail1">Booking Type <span class="fa fa-asterisk"></span></label> 
                            <select class="form-control" name="booking_type" id="booking_type" required onchange="amontAdd()">
                            <option selected disabled>Select Package Type</option>
                            @foreach ($biventsBookingTypes as $biventsBookingType)
                                <option value="{{$biventsBookingType->id}}">{{$biventsBookingType->name}}-(+INR {{$biventsBookingType->package_price}})-{{$biventsBookingType->remarks}}</option>
                            @endforeach 
                             </select>                    
                        <p class="text-danger">{{ $errors->first('booking_type') }}</p>
                        </div>
                        <div class="col-lg-4 form-group">
                            <label>Total Amount</label> 
                            <button  class="btn btn-success btn-sm"  readonly id="total_amount_show" style="width: 100px">0</button>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-lg-4 form-group">
                            <label>Contact Person Name <span class="fa fa-asterisk"></span></label> 
                            <input  name="contact_person_name" class="form-control"  maxlength="50" required value="{{ old('contact_person_name') }}" placeholder="Enter Name"> 
                        <p class="text-danger">{{ $errors->first('team_leader_name') }}</p>
                        </div>
                        <div class="col-lg-4 form-group">
                            <label>Mobile No. <span class="fa fa-asterisk"></span></label>
                            <input  name="contact_mobile_no" class="form-control" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required placeholder="Enter Mobile No."> 
                        <p class="text-danger">{{ $errors->first('contact_mobile_no') }}</p> 
                        </div>
                        <div class="col-lg-4 form-group">
                            <label>Email ID <span class="fa fa-asterisk"></span> (You Will Receive Ticket PDF on This Email.) </label> 
                            <input  name="email_id" class="form-control" required value="{{ old('email_id') }}" placeholder="Enter Email">
                            <p class="text-danger">{{ $errors->first('email_id') }}</p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12 form-group text-center" style="margin-top: 35px;">
                            <input type="submit" class="btn" value="Booking" style="width: 250px;background-color:#f2cb2f">
                        </div>
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
  
    var counter = 4;
    @foreach ($biventsBookingTypes as $brate)
        brate_ad[counter] = {{$brate->package_price}};
       
        counter = counter - 1;    
    @endforeach
    
    function amontAdd() {
        booking_type = $('#booking_type').val() ;
        totalAmount=0;

       totalAmount=brate_ad[booking_type];
        $('#total_amount_show').html(totalAmount); 
    }
    
   
        
  
   </script>

@include('front.footer')
<!--Footer Wrap End-->
<!--Back to Top Wrap Start-->


