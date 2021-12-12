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
                <form action="{{ route('admin.generate.store') }}" method="post">
                  
                      <div class="col-lg-12">
                          <label>Users</label>
                          <select name="user_id" class="form-control select2">
                              <option selected disabled>Select User</option>
                              @foreach ($users as $user)
                              <option value="{{ $user->id }}">{{ $user->name }}-{{ $user->mobile_no }}-{{ $user->email_id }}</option> 
                              @endforeach 
                          </select>
                      </div>
                      <div>
                          <input type="submit" class="btn btn-success">
                      </div>
                  
                </form>
            </div> 
        </div>
    </div>
</section>
@endsection 

