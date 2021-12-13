@include('front.header')
<div class="login-box"> 
     <!-- Main content -->
    <section class="content">
        <div class="box"> 
            <div class="box-body">
              <div class="login-box-body">
                <h4 class="login-box-msg bg-danger text-info text-center" style="padding-top: 15px">Payment Successful</h4> 
                 </br>
                 <div class="row"> 
                   {{-- <div class="col-xs-4 pull-right">
                   	<a href="{{ route('payment.form') }}" title="">
                     <button  class="btn btn-primary">Try Again  </button>
                     </a>
                   </div> --}}
                  
                 </div>
              </div> 
            </div>  
     <!-- /.content -->
   </div>

     </section>
   <!-- /.content-wrapper -->
 
</div>
@include('front.footer')
 