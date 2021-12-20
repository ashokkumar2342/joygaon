<!--Header Wrap Start-->
@include('front.header')
<!--Header Wrap End--> 
<!-- About Start here -->
<section class="about about-two">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="about-content table-responsive">
                    <h4 style="font-size: 36px;color: #ffc000;text-align: center;">Booking Your Ticket List</h4>

                    <table class="table table-bordered table-responsive" style="margin-top: 20px;">
                        <thead style="background-color: #605f6a;color: #fff">
                            <tr>
                                <th>Order Id</th>
                                <th>Ticket No.</th>
                                <th>Booking Date</th>
                                <th>Trip Date</th>
                                <th>Action</th>
                            </tr>
                        </thead> 
                        <tbody> 
                            @foreach ($bookLists as $bookList)        
                            <tr>
                                <td>{{$bookList->order_id}}</td>
                                <td>{{$bookList->id}}</td>
                                <td>{{date('d-m-Y',strtotime($bookList->booking_date))}}</td>
                                <td>{{date('d-m-Y',strtotime($bookList->trip_date))}}</td>
                                <td>
                                   
                                    @if ($bookList->status==1) 
                                        <a href="{{ route('admin.download.ticket',Crypt::encrypt($bookList->order_id)) }}" class="btn btn-xs btn-success" target="_blank" > <i class="fa fa-download"></i> Download Ticket</a>
                                    @endif
                                
                                </td>        
                                
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
@include('front.footer')