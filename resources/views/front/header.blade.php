
<!DOCTYPE html>
<html lang="en">       
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Kid Template for Children and child.">
  <meta name="keywords" content="child,children,school,childcare,colorful">
  <meta name="author" content="2goodtheme">
  <meta name="theme-color" content="#508e4c">
  <meta name="msapplication-navbutton-color" content="#508e4c">
  <meta name="apple-mobile-web-app-bar-style" content="#508e4c">
  <title>Best Weekend Getaways, Holiday Destinations near Delhi NCR - Joygaon</title>
  <!-- Swiper Slider CSS -->
  <link href="{{asset('front_asset/css/swiper.css')}}" rel="stylesheet">
  <!-- Custom Main StyleSheet CSS -->
  <link href="{{asset('front_asset/style.css')}}" rel="stylesheet">
  <!-- Color CSS -->
  <link href="{{asset('front_asset/css/color.css')}}" rel="stylesheet">
  <!-- Responsive CSS -->
  <link href="{{asset('front_asset/css/responsive.css')}}" rel="stylesheet">
</head>
<style>

  .gt_gallery_wrap{
    width: 140%;
  }

</style>

<body> 
  <!--gt Wrapper Start-->  
  <div class="gt_wrapper"> 
    <header>
      <div class="" style="background-color:#508e4c">
        <div class="container" >
          <div >
            <ul class="gt_hdr3_scl_icon" style="text-align: center;">
              <li><a href="#" id="id1"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#" id="id2"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#" id="id3"><i class="fa fa-google-plus"></i></a></li>
              <li><a href="#" id="id4"><i class="fa fa-linkedin"></i></a></li>
              <a class="btn-xs" id="btn_1" href="{{ route('admin.login') }}" title="" style="color:#fff"><i class="fa fa-user"></i> Sign In </a>
              <a class="btn-xs" id="btn_2" href="{{ route('admin.register') }}" title="" style="color:#fff"> <i class="fa fa-user"></i> Register </a>
            </li>
          </ul>
        </div> 
      </div>
    </div> 
    <div class="gt_top3_menu default_width bg-info">
      <div class="container"> 
        <div class="gt-logo" style="padding: 2px 0px;">
          <a href="{{ route('front.index') }}"><img src="{{asset('front_asset/images/logo.png')}}" alt="" style="float: left;"></a>
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
            <li><a  href="{{ route('front.index') }}">Home</a></li>
            <li><a  href="{{ route('front.book') }}">Booking</a></li>
            <li><a href="{{ route('front.about') }}">About Us</a></li>
            <li><a href="{{ route('front.gallery') }}">Gallery</a> 
            <li><a href="{{ route('front.price.list') }}">Price List</a></li> 
            <li><a href="{{ route('front.cotactus') }}">Contact Us</a></li>
            </ul>
          </nav>
        </div>
        
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


    </script>