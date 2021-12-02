
<!DOCTYPE html>
<html lang="en">       
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Kid Template for Children and child.">
    <meta name="keywords" content="child,children,school,childcare,colorful">
    <meta name="author" content="2goodtheme">

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
        <!--Header Wrap Start-->
        <header>
            <div class="gt_top3_wrap default_width">
                <div class="container">
                    <div class="gt_top3_scl_icon">
                        <ul class="gt_hdr3_scl_icon">
                           {{--  <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li> --}}
                        </ul>
                    </div>
                    <div class="gt_hdr_3_ui_element">
                        <ul>
                            <li><i class="fa fa-phone"></i>+124 456 7858</li>
                            <li><i class="fa fa-envelope-o"></i><a href="#">info@joygaon.in</a></li> 
                            <li><a class="btn-primary btn-sm" href="{{ route('admin.login') }}" title=""><i class="fa fa-user"></i>Sign In</a></li> 
                            <li><a class="btn-info btn-sm" href="{{ route('admin.register') }}" title=""> <i class="fa fa-user"></i>Register</a></li> 
                        </ul>
                    </div> 
                </div>
            </div> 
            <div class="gt_top3_menu default_width">
                <div class="container"> 
                    <div class="gt-logo" style="padding: 2px 0px;">
                        <a href="#"><img src="{{asset('front_asset/images/logo.png')}}" alt=""></a>
                    </div>
                    <nav class="gt_hdr3_navigation">
                        <!-- Responsive Buttun -->
                        <a class="navbar-btn collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>   
                        <!-- Responsive Buttun -->
                        <ul class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <li><a href="{{ route('front.index') }}">Home</a></li>
                            <li><a href="{{ route('front.about') }}">About Us</a></li>
                            <li><a href="{{ route('front.gallery') }}">Gallery</a> 
                            <li class="active"><a href="{{ route('front.price.list') }}">Price List</a></li> 
                            <li><a href="{{ route('front.cotactus') }}">Contact Us</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </header>
            <!--Header Wrap End--> 
            
            <!-- About Start here -->
            <section class="about about-two">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="about-content">
                                <h4 style="font-size: 36px;color: #ffc000;text-align: center;">Welcome To Joygaon</h4>
                                    <table class="table" style="margin-top: 20px">
                                        <thead style="background-color: #605f6a;color: #fff">
                                            <tr>
                                                <th>Sr.No.</th>
                                                <th>Booking Type</th>
                                                <th>Adults</th>
                                                <th>Children</th>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            @foreach ($priceLists as $priceList) 
                                            <tr>
                                                <td>{{$priceList->id}}</td>
                                                <td>{{$priceList->name}}</td>
                                                <td>{{$priceList->ad_amount}}</td>
                                                <td>{{$priceList->ch_amount}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        
                                    </table>

                            </div><!-- about content -->
                        </div> 
                    </div><!-- row -->
                </div><!-- container -->
            </section><!-- about -->
            <!-- About End here -->      
            <!--Main Content Wrap Start-->
            
            
            <!--Footer Wrap Start-->
            <footer> 
                <!--Footer Wrap Start-->
                <div class="gt_footer_bg default_width">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="default_width">
                                    <div class="gt_office_time widget">
                                        <h5>Opening Hour</h5>
                                        <ul>
                                            <li class="bg-warning">
                                               9:30 a.m. to 5 p.m. Every Day
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="gt_foo_about widget">
                                        <h5>About Joygaon</h5>
                                        <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin nibh vel velit auctor aliquet.</p>
                                        <ul>
                                           {{--  <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li> --}}
                                        </ul>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-9">
                                <div class="foo_col_outer_wrap default_width">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="gt_foo_news widget">
                                                <h5>Price List</h5>
                                                <ul> 
                                                    <li>
                                                        
                                                        <span>Adult 1000</span>
                                                    </li>
                                                    <li>
                                                      
                                                        <span>Children 1000</span>
                                                    </li>   
                                                </ul>
                                            </div>
                                        </div> 
                                        <div class="col-md-4 col-sm-6">
                                            <div class="gt_foo_recent_projects widget">
                                                <h5>Our Gallery</h5>
                                                <ul>
                                                    <li><img src="{{asset('front_asset/gallery/1.jpg')}}" alt=""></a></li>
                                                    <li><img src="{{asset('front_asset/gallery/2.jpg')}}" alt=""></a></li>
                                                    <li><img src="{{asset('front_asset/gallery/3.jpg')}}" alt=""></a></li>
                                                    <li><img src="{{asset('front_asset/gallery/4.jpg')}}" alt=""></a></li>
                                                    <li><img src="{{asset('front_asset/gallery/5.jpg')}}" alt=""></a></li>
                                                    <li><img src="{{asset('front_asset/gallery/9.jpg')}}" alt=""></a></li>
                                                    
                                                </ul>
                                            </div>
                                        </div> 
                                        <div class="col-md-4 col-sm-6">
                                            <div class="widget">
                                                <h5>Our Address</h5>
                                                <ul class="gt_team1_contact_info">
                                                    <li><i class="fa fa-map-marker"></i>Village Kablana, 9 Milestone, Jhajjar Bahadurgarh Road, Jhajjar, Haryana, 124104, INDIA </li>
                                                    <li><i class="fa fa-phone"></i>1-677-124-44227 </li>
                                                    <li><i class="fa fa-envelope"></i> <a href="#">info@joygaon.in</a> </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <!--Footer Wrap End--> 
                <!--Copyright Wrap Start-->
                <div class="copyright_bg default_width">
                    <div class="container">
                        <div class="copyright_wrap default_width">
                            <p>©copyrights.<a href="#">joygaon.in</a>. All Right Reserved.</p>
                        </div>
                    </div>
                </div>  
                <!--Copyright Wrap End-->      
            </footer> 
            <!--Footer Wrap End-->
            <!--Back to Top Wrap Start-->
            <div class="back-to-top">
                <a href="#home"><i class="fa fa-angle-up"></i></a>
            </div>
            <!--Back to Top Wrap Start--> 
        </div>
        <!--gt Wrapper End--> 
        <!--Jquery Library-->
        <script src="{{asset('front_asset/js/jquery.js')}}"></script>
        <!--Bootstrap core JavaScript-->
        <script src="{{asset('front_asset/js/bootstrap.min.js')}}"></script>
        <!--Swiper JavaScript-->
        <script src="{{asset('front_asset/js/swiper.jquery.min.js')}}"></script>
        <!--Accordian JavaScript-->
        <script src="{{asset('front_asset/js/jquery.accordion.js')}}"></script>
        <!--Count Down JavaScript-->
        <script src="{{asset('front_asset/js/jquery.downCount.js')}}"></script>
        <!--Pretty Photo JavaScript-->
        <script src="{{asset('front_asset/js/jquery.prettyPhoto.js')}}"></script>
        <!--Owl Carousel JavaScript-->
        <script src="{{asset('front_asset/js/owl.carousel.js')}}"></script>
        <!--Number Count (Waypoint) JavaScript-->
        <script src="{{asset('front_asset/js/waypoints-min.js')}}"></script>
        <!--Filter able JavaScript-->
        <script src="{{asset('front_asset/js/jquery-filterable.js')}}"></script>
        <!--WOW JavaScript-->
        <script src="{{asset('front_asset/js/wow.min.js')}}"></script>
        <!--Custom JavaScript-->
        <script src="{{asset('front_asset/js/custom.js')}}"></script>

    </body>

    </html>
