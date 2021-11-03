@extends('admin.layout.base')
@section('body')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Payment</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right"> 
                </ol>
            </div>
        </div>
        <div class="card" style="border: solid #7d3251e3">
          <div class="card-header bg-info">
            <h3 class="card-title">Request List</h3>
          </div>
          <div class="table-responsive" style="height:170px;overflow-y:scroll">
            <table class="table" id="rr_list">
                <thead>
                    <tr> 
                        <th>Payment Option</th>
                        <th>Date</th>
                        <th>No.</th>
                        <th>Status</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($recharge_request_list as $rr_list)
                        @php
                            if($rr_list->status==0){
                                $color='bg-warning';
                            }elseif($rr_list->status==1){
                                $color='bg-success';
                            }elseif($rr_list->status==2){
                                $color='bg-danger';
                            }
                        @endphp
                        <tr class="{{$color}}">
                            <td>{{$rr_list->package_name}}</td>
                            <td>{{$rr_list->name}}</td>
                            <td>{{date('d-m-Y',strtotime($rr_list->transaction_date))}}</td>
                            <td>{{$rr_list->transaction_no}}</td>
                            <td>{{$rr_list->trans_status}}</td>
                            <td>{{$rr_list->remarks}}</td>
                        </tr>
                    @endforeach --}}

                    
                </tbody>
            </table>
            </div>
        </div>
        <div class="card card-info" style="border: solid #58697b"> 
            <div class="card-body">
                <form action="#" method="post" class="add_form" content-refresh="rr_list">
                {{ csrf_field() }}
                <div class="row">
                <div class="col-lg-3 form-group">
                    <label>Amount</label>
                    <select name="amount" class="form-control">
                        {{-- @foreach ($recharge_packages as $recharge_package)
                            <option value="{{ $recharge_package->id }}">{{ $recharge_package->package_name }}</option> 
                        @endforeach --}} 
                    </select>
                </div> 
                    <div class="col-lg-3 form-group">
                        <label>Payment Mode</label>
                        <select name="payment_mode" class="form-control" onchange="callAjax(this,'{{ route('admin.qrcode') }}','payment_option_show')">
                            <option selected disabled>Select Payment Mode</option>
                            @foreach ($paymentModes as $paymentMode)
                             <option value="{{ $paymentMode->id }}">{{ $paymentMode->name }}</option>  
                            @endforeach
                         </select> 
                    </div>
                    @php
                         $date=date('d-m-Y');
                     @endphp 
                    <div class="col-lg-3 form-group">
                        <label>Transaction Date</label>
                        <input type="date" name="transaction_date" class="form-control" max="{{ date('Y-m-d',strtotime($date)) }}"> 
                    </div>
                    <div class="col-lg-3 form-group">
                        <label>Transaction No</label>
                        <input type="text" name="transaction_no" class="form-control"> 
                    </div> 
                    <div class="col-lg-12 form-group"> 
                        <input type="submit" class="form-control btn btn-primary">
                    </div>
                </div> 
                </form> 
             </div>
             <div id="payment_option_show">
                 
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

