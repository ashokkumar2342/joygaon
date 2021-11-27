@extends('admin.layout.base')
@section('body')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3></h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right"> 
                </ol>
            </div>
        </div>
        <div class="card">
            <div class="card-body"> 
                <div class="table-responsive">
                    <table class="table table-bordered" id="rr_list">
                        <thead style="background-color: #605f6a;color: #fff">
                            <tr> 
                                <th>Order ID</th>
                                <th>Booking ID</th>
                                <th>Date</th>
                                <th>Children</th>
                                <th>Adult</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paymentStatus as $rr_list)
                                @php
                                    if($rr_list->status==0){
                                        $color='bg-warning';
                                        $status='Payment Pending';
                                    }elseif($rr_list->status==1){
                                        $color='bg-success';
                                        $status='Payment Success';
                                    }elseif($rr_list->status==2){
                                        $color='bg-danger';
                                        $status='Order Cancel';
                                    }
                                @endphp
                                <tr class="">
                                    <td>{{$rr_list->order_id}}</td>
                                    <td>{{$rr_list->booking_id}}</td>
                                    <td>{{date('d-m-Y',strtotime($rr_list->booking_date))}}</td>
                                    <td>{{$rr_list->children}}</td>
                                    <td>{{$rr_list->adults}}</td>
                                    <td>{{$rr_list->amount}}</td>
                                    <td class="{{$color}}">{{$status}}</td>
                                    <td>
                                    
                                        @if ($rr_list->status==0)
                                            <a href="{{ route('admin.pay.again',Crypt::encrypt($rr_list->booking_id)) }}" class="btn btn-sm btn-info">PAY Again</a>
                                        @endif
                                        @if ($rr_list->status==1)
                                            <a href="#" class="btn btn-sm btn-danger">Cancel</a>
                                            <a href="#" class="btn btn-sm btn-default">Print</a>
                                        @endif
                                        @if ($rr_list->status==2)
                                            <a href="#" class="btn btn-sm btn-warning">Restore</a>
                                            
                                        @endif
                                    </td>
                                </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
    </div>
</section>
@endsection
@push('scripts')
<script type="text/javascript"> 
 function dateValiDation(argument) {alert(argument);
     
 }
</script> 
@endpush

