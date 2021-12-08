<header>
<div class="" style="background-color:#508e4c">
<div class="container" >
    <div >
        <ul class="gt_hdr3_scl_icon" style="text-align: center;">
            <li><a href="#" id="id1"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#" id="id2"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#" id="id3"><i class="fa fa-google-plus"></i></a></li>
            <li><a href="#" id="id4"><i class="fa fa-linkedin"></i></a></li>
            <a class="btn-xs" id="btn_1" href="{{ route('admin.login') }}" title="" style="color:#fff"><i class="fa fa-user"></i>Sign In</a>
            <a class="btn-xs" id="btn_2" href="{{ route('admin.register') }}" title="" style="color:#fff"> <i class="fa fa-user"></i>Register</a>
        </li>
        </ul>
    </div> 
</div>
</div> 
<div class="gt_top3_menu default_width bg-info">
<div class="container"> 
    <div class="gt-logo" style="padding: 2px 0px;">
        <a href="#"><img src="{{asset('front_asset/images/logo.png')}}" alt="" style="float: left;"></a>
    </div>
    <nav class="gt_hdr3_navigation">
        <!-- Responsive Buttun -->
        <a class="navbar-btn collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" style="float: right;margin-top:-60px">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>   
        <!-- Responsive Buttun -->
        <ul class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <li><a id="home" href="{{ route('front.index') }}">Home</a></li>
            <li><a href="{{ route('front.about') }}">About Us</a></li>
            <li><a href="{{ route('front.gallery') }}">Gallery</a> 
            <li><a href="{{ route('front.price.list') }}">Price List</a></li> 
            <li><a href="{{ route('front.cotactus') }}">Contact Us</a></li>
            </ul>
        </nav>
    </div>
    <hr>
</div>
</header>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

  $('#id1').mouseover(function(){
    $('#id1').css("color", "#ffc000");
  });
  $('#id1').mouseout(function(){
    $('#id1').css("color", "#fff");
  });
  $('#id2').mouseover(function(){
    $('#id2').css("color", "#ffc000");
  });
  $('#id2').mouseout(function(){
    $('#id2').css("color", "#fff");
  });
  $('#id3').mouseover(function(){
    $('#id3').css("color", "#ffc000");
  });
  $('#id3').mouseout(function(){
    $('#id3').css("color", "#fff");
  });
  $('#id4').mouseover(function(){
    $('#id4').css("color", "#ffc000");
  });
  $('#id4').mouseout(function(){
    $('#id4').css("color", "#fff");
  });

  $('#btn_1').mouseover(function(){
    $('#btn_1').css("color", "#ffc000");
  });
  $('#btn_1').mouseout(function(){
    $('#btn_1').css("color", "#fff");
  });
  $('#btn_2').mouseover(function(){
    $('#btn_2').css("color", "#ffc000");
  });
  $('#btn_2').mouseout(function(){
    $('#btn_2').css("color", "#fff");
  });
  $('#home').mouseover(function(){
    $('#home').css("color", "#508e4c");
  });
  $('#home').mouseout(function(){
    $('#home').css("color", "#508e4c");
  });
  

</script>