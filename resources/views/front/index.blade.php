
<!DOCTYPE html>
<html lang="en">
@php
    // $schoolDetail = App\Helper\MyFuncs::getSchoolDetailContactEmail();
    // $hostingType = App\Helper\MyFuncs::getHostingType();
@endphp
                          
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Kid Template for Children and child.">
    <meta name="keywords" content="child,children,school,childcare,colorful">
    <meta name="author" content="2goodtheme">

    <title>{{-- {{$schoolDetail[0]->name}} --}}</title>
    <!-- Swiper Slider CSS -->
    <link href="{{asset('front_asset/css/swiper.css')}}" rel="stylesheet">
    <!-- Custom Main StyleSheet CSS -->
    <link href="{{asset('front_asset/style.css')}}" rel="stylesheet">
    <!-- Color CSS -->
    <link href="{{asset('front_asset/css/color.css')}}" rel="stylesheet">
    <!-- Responsive CSS -->
    <link href="{{asset('front_asset/css/responsive.css')}}" rel="stylesheet">
  </head>

  <body>

<!--gt Wrapper Start-->  
<div class="gt_wrapper">

    
    <!--Header Wrap Start-->
    <header>
        <div class="gt_top3_wrap default_width">
            <div class="container">
                <div class="gt_top3_scl_icon">
                    <ul class="gt_hdr3_scl_icon" style="color: #fff;margin-top: 2px">
                    	<li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    	<li><i class="icon fa fa-phone"></i> Mobile No. : +91-8397068001</li>
                    	<li><a href="#"><i class="fa fa-envelope-o"></i> Email : Info@joygaon.in </a></li> 
                    </ul>
                </div>
                <div class="gt_hdr_3_ui_element">
                    <ul> 
                       <li><a class="btn btn-primary btn-sm" href="{{ route('admin.login') }}" title=""><i class="fa fa-user"></i>Sign In</a></li>

                       <li><a class="btn btn-info btn-sm" href="{{ route('admin.register') }}" title=""> <i class="fa fa-user"></i>Register</a></li> 
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
                        <li class="active"><a href="javascript:avoid(0);">Home</a>
                             
                        </li>
                        <li><a href="$">About Us</a></li>
                        <li><a href="javascript:avoid(0);">Product</a> 
                        <li><a href="javascript:avoid(0);">Enquery</a> 
                        </li>
                       {{--  @if ($hostingType == 1)
                            <li><a href="{{ route('try.demo') }}">Try Demo</a></li>
                        @endif  --}} 
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <!--Header Wrap End-->

    <!--Banner Wrap Start-->
    <div class="gt_banner default_width">
        <div class="swiper-container" id="swiper-container">
             <ul class="swiper-wrapper">
                <li class="swiper-slide" style="height: 750px">
                    <img src="{{asset('front_asset/extra-images/banner-1.jpg')}}" alt="">
                    <div class="gt_banner_text gt_slide_1">
                        
                    </div>
                </li>
                <li class="swiper-slide" style="height: 750px">
                    <img src="{{asset('front_asset/extra-images/banner-02.jpg')}}" alt="">
                    <div class="gt_banner_text gt_slide_2">
                        
                    </div>
                </li>
                <li class="swiper-slide" style="height: 750px">
                    <img src="{{asset('front_asset/extra-images/banner-03.jpg')}}" alt="">
                    <div class="gt_banner_text gt_slide_3">
                        
                    </div>
                </li>
                 <li class="swiper-slide" style="height: 750px">
                    <img src="{{asset('front_asset/extra-images/banner-04.jpg')}}" alt=""> 
                    <div class="gt_banner_text gt_slide_3">
                        
                    </div>
                </li>
             </ul>
         </div>
        <div class="swiper-button-next"><i class="fa fa-angle-right"></i></div>
        <div class="swiper-button-prev"><i class="fa fa-angle-left"></i></div>
    </div>
    <!--Banner Wrap End-->

    <!--Main Content Wrap Start-->
    <div class="gt_main_content_wrap">
        <!--Banner Services Wrap Start-->
        <div class="gt_servicer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="gt_main_services bg_1">
                            <i class="icon-write-board"></i>
                            <h5>Unlimited Users</h5>
                            <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. </p>
                            <a  class="bg_1" href="#"> <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="gt_main_services bg_2">
                            <i class="icon-teacher-showing-on-whiteboard"></i>
                            <h5>Unlimited Courses & Batches</h5>
                            <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. </p>
                             <a class="bg_2" href="#"> <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="gt_main_services bg_3">
                            <i class="icon-compass"></i>
                            <h5>Free Hosting</h5>
                            <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. </p>
                             <a class="bg_3" href="#"> <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="gt_main_services bg_4">
                            <i class="icon-number-blocks"></i>
                            <h5>Easy import and export of data</h5>
                            <p>Our fully functional software offers successful export and import of the data. </p>
                              <a class="bg_4" href="#"> <i class="fa fa-arrow-right"></i></a>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Banner Services Wrap End-->
        
        <!--Offer Wrap start-->
        <section class="gt_wht_offer_bg">
            <div class="container">
                <div class="gt_hdg_1">
                    <h3>WHAT WE OFFER</h3>
                    <p>Aenean commodo ligula eget dolor. Aenean massa. <span>elit, eget nibh etlibura.</span>
                    </p>
                    <span><img src="{{asset('front_asset/images/hdg-01.png')}}" alt=""></span>
                </div>
                <!--What We Offer 2 Wrap Start-->
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="gt_wht_offer_wrap mb">
                            <i class="icon-meat bg_1"></i>
                            <div class="gt_wht_offer_des">
                                <h5><a href="#">Cost cutting</a></h5>
                                <span class="bg_offer_1"></span>
                                <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet avida nibh vel velit auctor aliquet.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="gt_wht_offer_wrap mb">
                            <i class="icon-pencil bg_2"></i>
                            <div class="gt_wht_offer_des">
                                <h5><a href="#">24*7 accessibility</a></h5>
                                <span class="bg_offer_2"></span>
                                <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet avida nibh vel velit auctor aliquet.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="gt_wht_offer_wrap mb">
                            <i class="icon-write-board bg_3"></i>
                            <div class="gt_wht_offer_des">
                                <h5><a href="#">User friendly</a></h5>
                                <span class="bg_offer_3"></span>
                                <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet avida nibh vel velit auctor aliquet.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="gt_wht_offer_wrap mb">
                            <i class="icon-translation bg_4"></i>
                            <div class="gt_wht_offer_des">
                                <h5><a href="#">Well-structured modules</a></h5>
                                <span class="bg_offer_4"></span>
                                <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet avida nibh vel velit auctor aliquet.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="gt_wht_offer_wrap mb">
                            <i class="icon-color bg_5"></i>
                            <div class="gt_wht_offer_des">
                                <h5><a href="#">Customizable</a></h5>
                                <span class="bg_offer_5"></span>
                                <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet avida nibh vel velit auctor aliquet.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="gt_wht_offer_wrap mb">
                            <i class="icon-crayons bg_6"></i>
                            <div class="gt_wht_offer_des">
                                <h5><a href="#">Anytime, anywhere available</a></h5>
                                <span class="bg_offer_6"></span>
                                <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet avida nibh vel velit auctor aliquet.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--What We Offer 2 Wrap End-->
            </div>
        </section>
        <!--offer Wrap End-->
        
    <!--Footer Wrap Start-->
    <footer>
        <!--NewsLetter Wrap Start-->
        <div class="gt_newsltr_bg default_width">
            <div class="container">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <div class="gt_newsltr_wrap">
                            <form>
                                <input type="text" placeholder="Enter your email">
                                <input class="button_style_1 btn_lg" type="submit" value="Subscribe">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--NewsLetter Wrap End-->

        <!--Footer Wrap Start-->
        <div class="gt_footer_bg default_width">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="gt_office_wrap default_width">
                            <div class="gt_office_time widget">
                                <h5>Opening Hour</h5>
                                <ul>
                                    <li>
                                        Monday - Friday
                                        <span>9am to 5pm</span>
                                    </li>
                                    <li>
                                        Saturady - Sunday 
                                        <span>off</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="gt_foo_about widget">
                                <h5>About Kidscenter</h5>
                                <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin nibh vel velit auctor aliquet.</p>
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="foo_col_outer_wrap default_width">
                            <div class="row">
                                <div class="col-md-4 col-sm-6">
                                    <div class="gt_foo_news widget">
                                        <h5>Latest News</h5>
                                        <ul>
                                            <li>
                                                <figure>
                                                    <img src="extra-images/foo-news-01.jpg" alt="">
                                                </figure>
                                                <div class="foo_news_content">
                                                    <a href="#">Lorem ipsum dolor sit amet dolor sit amet</a>
                                                    <ul>
                                                        <li>
                                                            <i class="fa fa-calendar"></i>
                                                            <span>07-March-2016</span>
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-comments-o"></i>
                                                            <span>20</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <figure>
                                                    <img src="extra-images/foo-news-02.jpg" alt="">
                                                </figure>
                                                <div class="foo_news_content">
                                                    <a href="#">Lorem ipsum dolor sit amet dolor sit amet</a>
                                                    <ul>
                                                        <li>
                                                            <i class="fa fa-calendar"></i>
                                                            <span>07-March-2016</span>
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-comments-o"></i>
                                                            <span>20</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6">
                                    <div class="gt_foo_recent_projects widget">
                                        <h5>Our Gallery</h5>
                                        <ul>
                                            <li><a href="#"><img src="extra-images/foo-news-03.jpg" alt=""></a></li>
                                            <li><a href="#"><img src="extra-images/foo-news-04.jpg" alt=""></a></li>
                                            <li><a href="#"><img src="extra-images/foo-news-05.jpg" alt=""></a></li>
                                            <li><a href="#"><img src="extra-images/foo-news-06.jpg" alt=""></a></li>
                                            <li><a href="#"><img src="extra-images/foo-news-07.jpg" alt=""></a></li>
                                            <li><a href="#"><img src="extra-images/foo-news-08.jpg" alt=""></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6">
                                    <div class="widget">
                                        <h5>Our Address</h5>
                                        <ul class="gt_team1_contact_info">
                                            <li><i class="fa fa-map-marker"></i>14350 60th St North Clearwater FL. 33760 </li>
                                            <li><i class="fa fa-phone"></i>1-677-124-44227 </li>
                                            <li><i class="fa fa-envelope"></i> <a href="#">info@kidscenter.com</a> </li>
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
                    <p>©copyrights.<a href="#">Kidscenter.com</a>. All Right Reserved.</p>
                    <span>Designed By: <a href="#">2GoodTemplate</a></span>
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
