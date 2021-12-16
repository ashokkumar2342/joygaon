
@include('front.header')
<style>
    label {
    color: #0d0209;
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
                        <div class="col-lg-12 form-group"> 
                            <label for="exampleInputEmail1">Booking Type <span class="fa fa-asterisk"></span></label> 
                            <select class="form-control" name="booking_type" id="booking_type" required onchange="amontAdd()">
                            <option selected disabled>Select Package Type</option>
                            @foreach ($biventsBookingTypes as $biventsBookingType)
                                <option value="{{$biventsBookingType->id}}">{{$biventsBookingType->name}}-(+INR{{$biventsBookingType->package_price}})-{{$biventsBookingType->remarks}}</option>
                            @endforeach 
                             </select>                    
                        <p class="text-danger">{{ $errors->first('booking_type') }}</p>
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
                            <input  name="contact_mobile_no" class="form-control" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required value="{{$mobile_no}}" readonly placeholder="Enter Mobile No."> 
                        <p class="text-danger">{{ $errors->first('contact_mobile_no') }}</p> 
                        </div>
                        <div class="col-lg-4 form-group">
                            <label>Email ID <span class="fa fa-asterisk"></span> (You Will Receive Ticket PDF on This Email.) </label> 
                            <input  name="email_id" class="form-control" required value="{{ old('email_id') }}" placeholder="Enter Email">
                            <p class="text-danger">{{ $errors->first('email_id') }}</p>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-lg-6 form-group">
                            <label>ID Card Upload</label> 
                            <input type="file" name="idcard" class="form-control"> 
                        <p class="text-danger">{{ $errors->first('adults') }}</p> 
                        </div> 
                        <div class="col-lg-6 form-group">
                            <label>Total Amount</label> 
                            <input type="text" name="total_amount" class="form-control"  readonly id="total_amount_show" value="0">
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
    
    function amontAdd() {
        booking_type = $('#booking_type').val() ;
        totalAmount=0;
        if (booking_type==1) {
            totalAmount=2200;
        }
        if (booking_type==2) {
            totalAmount=3000;
        }
        if (booking_type==3) {
            totalAmount=4000;
        }
        if (booking_type==4) {
            totalAmount=6500;
        }
        $('#total_amount_show').val(totalAmount); 
    }
    
   
        
  
   </script>

@include('front.footer')
<!--Footer Wrap End-->
<!--Back to Top Wrap Start-->


