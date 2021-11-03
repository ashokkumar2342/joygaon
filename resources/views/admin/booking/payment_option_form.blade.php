<div class="row">
@if ($paymentmodeid==1)
<div class="col-lg-4 form-group">
<label>Account No.</label>
<input type="text" name="account_no" class="form-control"> 
</div>
<div class="col-lg-4 form-group">
<label>Ifsc Code</label>
<input type="text" name="ifsc_code" class="form-control"> 
</div>
<div class="col-lg-4 form-group">
<label>Account Name</label>
<input type="text" name="account_name" class="form-control"> 
</div>
<div class="col-lg-6 form-group">
<label>Bank Name</label>
<input type="text" name="bank_name" class="form-control"> 
</div>
<div class="col-lg-6 form-group">
<label>Branch Name</label>
<input type="text" name="branch_name" class="form-control">
</div> 
 @endif
 @if ($paymentmodeid!=1)
<div class="col-lg-6 form-group">
<label>Account Name</label>
<input type="text" name="account_name" class="form-control"> 
</div>
<div class="col-lg-6 form-group">
<label>QR Code</label>
<input type="file" name="qr_code" class="form-control"> 
</div>  
@endif 
<div class="col-lg-12 form-group"> 
<input type="submit" class="form-control btn btn-primary">
</div>
</div>