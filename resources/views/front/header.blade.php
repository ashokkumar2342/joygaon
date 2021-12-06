<header>
<div class="gt_top3_wrap">
<div class="container">
    <div class="gt_top3_scl_icon">
        <ul class="gt_hdr3_scl_icon">
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
        </ul>
    </div>
    <div class="gt_hdr_3_ui_element">
        <ul>
        <li>
            <a class="btn-primary btn-sm" href="{{ route('admin.login') }}" title=""><i class="fa fa-user"></i>Sign In</a>&nbsp;
            <a class="btn-info btn-sm" href="{{ route('admin.register') }}" title=""> <i class="fa fa-user"></i>Register</a>
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
            <li class="active"><a href="{{ route('front.index') }}">Home</a> 
            </li>
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