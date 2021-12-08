@include('front.header')
<!--Header Wrap End--> 
<!--Main Content Wrap Start-->
<div class="gt_main_content_wrap" style="margin-top:30px">
    <div class="gt_hdg_1">
        <h4 style="font-size: 36px;color: #ffc000">Gallery</h4> 
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">                            
                <iframe src="https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fwww.facebook.com%2Fjoygaon12%2Fvideos%2F808253496291964%2F&show_text=false&width=560&t=0" width="560" height="314" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
            </div>
            <div class="col-md-6">                            
                <iframe src="https://www.facebook.com/plugins/video.php?height=314&href=https://www.facebook.com/100004830724819/videos/798624393641911%2F&show_text=false&width=560&t=0" width="560" height="314" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
            </div>
            <div class="col-md-6">                            
                <iframe src="https://www.facebook.com/plugins/video.php?height=314&href=https://fb.watch/9oAVmPwQUF/&show_text=false&width=560&t=0" width="560" height="314" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
            </div>
            <div class="col-md-6">                            
                <iframe src="https://www.facebook.com/plugins/video.php?height=314&href=https://fb.watch/9xJ2dnivj3/&show_text=false&width=560&t=0" width="560" height="314" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
            </div>  
        </div>
    </div>
</div> 
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
    <!--Gallery List Wrap End-->
</section>
<!--Our Gallery Wrap End--> 
<!--Footer Wrap Start-->
@include('front.footer')

