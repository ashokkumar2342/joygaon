@if ($payment_mode_id==1)
<table class="table table-striped table-bordered">
     <thead>
         <tr>
             <th>Payment Mode</th>
             <th>Account No.</th>
             <th>Ifsc Code</th>
             <th>Account Name</th> 
             
         </tr>
     </thead>
     <tbody>
        @foreach ($paymentOptions as $paymentOption) 
         <tr >
             <td>{{ $paymentOption->name or '' }}</td>
             <td>{{ $paymentOption->account_no }}</td>
             <td>{{ $paymentOption->ifsc_code }}</td>
             <td>{{ $paymentOption->account_name }}</td>
             
         </tr>
        @endforeach
     </tbody>
 </table> 
 @else
 <table class="table table-striped table-bordered">
     <thead>
         <tr>  
             <th>Account Name</th> 
             <th>QR Code</th> 
             
         </tr>
     </thead>
     <tbody>
        @foreach ($paymentOptions as $paymentOption) 
         <tr> 
             <td>{{ $paymentOption->account_name }}</td>
             <td><img src="{{ route('admin.qrcode.show',Crypt::encrypt($paymentOption->qr_code)) }}"  alt="" title="" /></td>
             
         </tr>
        @endforeach
     </tbody>
 </table> 
@endif
