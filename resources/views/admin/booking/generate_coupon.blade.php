@extends('admin.layout.base')
@section('body')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Generate Coupon</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right"> 
                </ol>
            </div>
        </div> 
        <div class="card card-info"> 
            <div class="card-body"> 
                <form action="{{ route('admin.coupon.post') }}" method="post" class="add_form">
                  {{csrf_field()}}
                  <div class="row">
                      <div class="col-lg-4 form-group">
                          <label>Users</label>
                          <span class="fa fa-asterisk"></span>
                          <select name="user_id" class="form-control select2">
                              <option selected disabled>Select User</option>
                              @foreach ($users as $user)
                              <option value="{{ $user->id }}">{{ $user->name }}-{{ $user->mobile_no }}-{{ $user->email_id }}</option> 
                              @endforeach 
                          </select>
                      </div>
                      <div class="col-lg-4 form-group">
                          <label>Coupan Code</label>
                          <span class="fa fa-asterisk"></span>
                          <input type="text" name="coupan_code" class="form-control" maxlength="8" minlength="8">
                      </div>
                      <div class="col-lg-4 form-group">
                          <label>Discount Percent</label>
                          <input type="text" name="discount_percent" class="form-control" maxlength="3" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                      </div>
                      <div class="col-lg-4 form-group">
                          <label>Discount Fix</label>
                          <input type="text" name="discount_fix" class="form-control" maxlength="3" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                      </div>
                      <div class="col-lg-4 form-group">
                          <label>Complementary Adult</label>
                          <input type="text" name="complemantry_adult" class="form-control" maxlength="3" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                      </div>
                      <div class="col-lg-4 form-group">
                          <label>Complementary Children</label>
                          <input type="text" name="complementry_child" class="form-control" maxlength="3" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                      </div>
                  </div>
                  <div class="col-lg-12 form-group text-center"> 
                    <input type="submit" class="btn btn-success">
                  </div> 
                </form>
            </div> 
        </div>
    </div>
</section>
@endsection 

