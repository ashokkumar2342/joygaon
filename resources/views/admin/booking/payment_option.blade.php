@extends('admin.layout.base')
@section('body')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Payment Option</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right"> 
                </ol>
            </div>
        </div> 
        <div class="card card-info"> 
            <div class="card-body">
                <form action="{{ route('admin.payment.option.store') }}" method="post" class="add_form" content-refresh="payment_option_list">
                {{ csrf_field() }}
                <div class="row"> 
                    <div class="col-lg-12 form-group">
                        <label>Payment Mode</label>
                        <select name="payment_mode" class="form-control" onchange="callAjax(this,'{{ route('admin.payment.option.form') }}','payment_option_form')">
                            <option selected disabled>Select Payment Mode</option>
                            @foreach ($paymentModes as $paymentMode)
                             <option value="{{ $paymentMode->id }}">{{ $paymentMode->name }}</option>  
                            @endforeach
                         </select> 
                    </div>
                </div>
                <div  id="payment_option_form">
                     
                </div> 
                </form>
                <table class="table table-striped table-bordered" id="payment_option_list">
                     <thead>
                         <tr>
                             <th>Payment Mode</th>
                             <th>Account No.</th>
                             <th>Ifsc Code</th>
                             <th>Account Name</th> 
                             <th>Action</th> 
                         </tr>
                     </thead>
                     <tbody>
                        @foreach ($paymentOptions as $paymentOption)
                        @php 
                            $image  =\Storage_path('app'.$paymentOption->qr_code);
                        @endphp      
                         <tr style="{{ $paymentOption->status==1?'background-color: #48a40d':'#6064600d' }}">
                             <td>{{ $paymentOption->name  }}</td>
                             <td>
                                @if ($paymentOption->account_no==null)
                                <img src="{{ $image }}" alt="" width="30px" height="30px">
                                @else
                                {{ $paymentOption->account_no }} 
                                @endif
                            </td>
                             <td>{{ $paymentOption->ifsc_code }}</td>
                             <td>{{ $paymentOption->account_name }}</td>
                             <td>
                                @if ($paymentOption->status==1)
                                  <a href="{{ route('admin.payment.option.status',$paymentOption->id) }}" title="" class="btn btn-xs btn-success">Active</a>   
                                @endif
                                @if ($paymentOption->status==0)
                                    <a href="{{ route('admin.payment.option.status',$paymentOption->id) }}" title="" class="btn btn-xs btn-default">InActive</a>
                                @endif 
                             </td>
                         </tr>
                        @endforeach
                     </tbody>
                 </table> 
             </div>
         </div>
     </div>
</section>
@endsection
@push('scripts')
<script type="text/javascript"> 
 
</script> 
@endpush

