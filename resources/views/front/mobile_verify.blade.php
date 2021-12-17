
@include('front.header')
<style>
label {
    color: #f9f3f3;
    display: block;
    font-weight: 400;
    margin-bottom: 10px;
}
#bac{
    background-image: url('{{asset('front_asset/images/banner2.jpg')}}');
    height: 650px;
}

</style>
<section class="about about-two" id="bac">
    <div class="container">
        <div class="card-body login-card-body">
            <form action="{{ route('front.mobile.verify.store') }}" method="post">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-12 form-group text-center">
                    <h3 style="color: #fff"><b>Enter Verification Code</b></h3>
                    <p class="login-box-msg" style="color: #fff">Check Your Mobile No. <b>****{{substr($mobile_no, 6)}}</b> For The Verification Code</p>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                      <input type="hidden" name="type" class="form-control hidden" value="{{$type}}">
                      <input type="hidden" name="mobile_no" class="form-control hidden" value="{{$mobile_no}}">
                    </div>
                    <div class="col-md-4 form-group">
                       <input type="text" name="code" class="form-control" placeholder="Enter Code"  required minlength="6" maxlength="6" onkeypress='return event.charCode >= 48 && event.charCode <= 57' {{old('code')}}>
                    </div>
                    <div class="col-md-4">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4">
                        <div class="captcha">
                        <span>{!! captcha_img('flat') !!}</span>
                        <button type="button" class="btn btn-warning form-group" onclick="refresh()"><i class="fa fa-refresh" ></i></button>
                        </div>
                        <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha" style="margin-top:5px" required>
                    <p class="text-danger">{{ $errors->first('captcha') }}</p>
                    </div>

                    <div class="col-md-4">

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 text-center">

                    </div>
                    <div class="col-lg-2 col-md-2  form-group text-center">
                        <input type="submit"  class="btn form-control" id="get_btn" value="Verify" style="background-color:#80cd33;color:#fff"> 
                        
                    </div>
                    <div class="col-lg-2 col-md-2  form-group text-center">
                        
                        <a href="{{ route('front.code.resend',Crypt::encrypt($mobile_no)) }}" class="btn  btn-warning form-control">Resend Code</a>
                    </div>
                    <div class="col-lg-4 form-group text-center">
                        
                    </div>

                </div>
            </form>
        </div>
  </div>
</section>
<script>
    function refresh(){
        $.ajax({
           type:'GET',
           url:'{{ route('admin.refresh.captcha') }}',
           success:function(data){
            $(".captcha span").html(data);
        }
    });
    }
    $('#get_btn').mouseover(function(){
        $('#get_btn').css("background-color", "#fff").css("color", "#000");
      });
      $('#get_btn').mouseout(function(){
        $('#get_btn').css("background-color", "#80cd33").css("color", "#fff");
      });2
</script>

@include('front.footer')


