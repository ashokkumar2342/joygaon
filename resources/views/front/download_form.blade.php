
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
                <form action="{{ route('front.download.show') }}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <label>Mobile No. <span class="fa fa-asterisk"></span></label>
                            <input  name="mobile_no" class="form-control" maxlength="10" minlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required placeholder="Enter Mobile No."> 
                        <p class="text-danger">{{ $errors->first('mobile_no') }}</p> 
                        </div>
                        <div class="col-lg-6 form-group">
                            
                        <input type="submit" class="btn btn-success form-control" value="Show" style="margin-top:30px;background-color:;color: #fff;">
                        </div>
                    </div>
              </form>  
           
        
    </div><!-- container -->
</section>

   <script>
    
   
        
  
   </script>

@include('front.footer')
<!--Footer Wrap End-->
<!--Back to Top Wrap Start-->


