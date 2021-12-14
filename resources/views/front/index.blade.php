
<!--Header Wrap Start-->
@include('front.header')
<div class="gt_banner default_width">
	<div class="swiper-container" id="swiper-container">
		<ul class="swiper-wrapper">
			<li class="swiper-slide">
				<img src="{{asset('front_asset/extra-images/banner-1.jpg')}}" alt="">
				<div class="gt_banner_text gt_slide_1"> 
				</div>
			</li>
			<li class="swiper-slide">
				<img src="{{asset('front_asset/extra-images/banner-02.jpg')}}" alt="">
				<div class="gt_banner_text gt_slide_2"> 
				</div>
			</li>

			<li class="swiper-slide">
				<img src="{{asset('front_asset/extra-images/banner-04.webp')}}" alt=""> 
				<div class="gt_banner_text gt_slide_3"> 
				</div>
			</li>
			<li class="swiper-slide">
				<img src="{{asset('front_asset/extra-images/banner-03.webp')}}" alt=""> 
				<div class="gt_banner_text gt_slide_3"> 
				</div>
			</li>
		</ul>
	</div>
	<div class="swiper-button-next" ><i class="fa fa-angle-right"></i></div>
	<div class="swiper-button-prev"><i class="fa fa-angle-left"></i></div>
</div>
<!--Banner Wrap End-->
<!--Main Content Wrap Start-->
<div class="gt_main_content_wrap" style="margin-top:10px">
	
	<div class="container">
		<div class="row">
			<div class="col-md-6 form-group">                            
				<iframe width="560" height="314" src="https://www.youtube.com/embed/Ru06lKBBfEE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
			<div class="col-md-6 form-group">                            
				<iframe src="https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fwww.facebook.com%2Fjoygaon12%2Fvideos%2F808253496291964%2F&show_text=false&width=560&t=0" width="560" height="314"  scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
			</div>
			<div class="col-md-6 form-group">                            
				<iframe width="560" height="314" src="https://www.youtube.com/embed/BzH6v9XFxi0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
			<div class="col-md-6 form-group">                            
				<iframe src="https://www.facebook.com/plugins/video.php?height=314&href=https://www.facebook.com/100004830724819/videos/798624393641911%2F&show_text=false&width=560&t=0" width="560" height="314"  scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
			</div> 
			
			
			  
		</div>
	</div>
</div>
<!-- About Start here -->
<section class="about about-two">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="about-content">
					<h4 style="font-size: 36px;color: #ffc000;text-align: center;">Welcome To Joygaon</h4>
					{{--  <img src="{{ asset('front_asset/extra-images/about_us_img.jpg') }}" align="right" alt="about image" class="img-responsive" style="height: 250px;"> --}} 
					<p style="text-align: justify;">Joygaon, A Unit of Sir Salasar Balaji Enterprises Private Limited is a Modern Indian Village surrounded by lush green agricultural fields in an Eco-friendly area. Joygaon shares an experience of an ethnic village culture, activities, hygienic food, dance, music along with Modern indoor/outdoor games and activities spread in an area of 12 acres.</p>
					<p style="text-align: justify;">Joygaon is situated on Haryana State Highway #22 which is about 35kms from Peeragarhi Chowk, Delhi, 40 kms from Gurgaon, 9 kms from Jhajjar, and 15 kms from Bahadurgarh, and 40 kms from Rohtak, turning out to be best weekend getaways in Delhi/NCR with Picnic & Luxurious Stay Facility. Joygaon is a one stop location to a perfect weekend getaway to spend with your family and friends.</p>

				</div><!-- about content -->
			</div> 
		</div><!-- row -->
	</div><!-- container -->
</section><!-- about -->
<!-- About End here --> 
<!--Banner Services Wrap End-->
<!--Our Gallery Wrap Start-->
<section class="gt_gallery_bg">
	<!--Main Heading Wrap Start-->
	<div class="gt_hdg_1">
		<h4 style="font-size: 36px;color: #ffc000">Our Gallery</h4>

	</div>
	<!--Main Heading Wrap End--> 
	<!--Gallery List Wrap Start-->
	<div class="gt_gallery_slider" id="gt_gallery_slider">
		<div class="item">
			<div class="gt_gallery_wrap">
				<img src="{{asset('front_asset/gallery/1.jpg')}}" alt="">
			</div>
		</div>
		<div class="item">
			<div class="gt_gallery_wrap">
				<img src="{{asset('front_asset/gallery/2.jpg')}}" alt="">
			</div>
		</div>
		<div class="item">
			<div class="gt_gallery_wrap">
				<img src="{{asset('front_asset/gallery/3.jpg')}}" alt="">
			</div>
		</div>
		<div class="item">
			<div class="gt_gallery_wrap">
				<img src="{{asset('front_asset/gallery/4.jpg')}}" alt="">
			</div>
		</div>
		<div class="item">
			<div class="gt_gallery_wrap">
				<img src="{{asset('front_asset/gallery/5.jpg')}}" alt="">
			</div>
		</div>
		<div class="item">
			<div class="gt_gallery_wrap">
				<img src="{{asset('front_asset/gallery/6.jpg')}}" alt="">
			</div>
		</div>
		<div class="item">
			<div class="gt_gallery_wrap">
				<img src="{{asset('front_asset/gallery/7.jpg')}}" alt="">
			</div>
		</div>
	</div>

</div>
	<!--Gallery List Wrap End-->
</section>
<!--Our Gallery Wrap End--> 
<!--Footer Wrap Start-->
<!-- Modal -->
  <div class="modal fade modal-xs" id="offer_model" role="dialog" style="margin-top: 180px">
    <div class="modal-dialog"> 
      <!-- Modal content-->
      <div class="modal-content">
        {{-- <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div> --}}
        <div class="modal-body">
        	<img src="{{asset('front_asset/images/discount_img.png')}}" alt="">
         </div>
        <div class="modal-footer">
          <a href="{{ route('front.mobile.form') }}" class="btn btn-success" >Book Now</a>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div> 
    </div>
  </div>
  <script type="text/javascript">
  	$('document').ready(function() {
  	   
  	    $('#offer_model').modal('show'); 
  	}); 
  	function callPopupL2(argument) {
  	 $('#offer_model_2').modal('show');	
  	} 
  	 
  </script> 
@include('front.footer')
<!--Footer Wrap End-->
<!--Back to Top Wrap Start-->

