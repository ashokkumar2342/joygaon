@extends('admin.layout.base')
@section('body')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Change Password</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right"> 
                </ol>
            </div>
        </div> 
        <div class="card card-info"> 
            <div class="card-body">
                <form name="usser_change_password" id="usser_change_password" toast-msg="true" action="{{ route('admin.change.password.store') }}"   class="add_form" method="post" autocomplete="off" >
                    {{ csrf_field()}}
                    <div class="form-body overflow-hide">
                        <div class="form-group">
                            <label class="control-label mb-10">Old Password (Min 6 Max 15 Characters )</label>
                            <span class="fa fa-asterisk"></span>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="icon-lock"></i></div>
                                <input type="password" class="form-control" name="oldpassword" id="oldpassword" placeholder="Enter old password" required="" maxlength="15" min="6">
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="control-label mb-10" for="exampleInputpwd_01">New Password (Min 6 Max 15 Characters )</label>
                            <span class="fa fa-asterisk"></span>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="icon-lock"></i></div>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter new password"  title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required maxlength="15"  min="6">
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="control-label mb-10" for="exampleInputpwd_01">Confirm password (Min 6 Max 15 Characters )</label>
                            <span class="fa fa-asterisk"></span>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="icon-lock"></i></div>
                                <input type="password" name="passwordconfirmation" class="form-control" id="passwordconfirmation" placeholder="Enter new password" required maxlength="15"  min="6">
                            </div>
                        </div>
                    </div>
                    <div class="form-actions mt-10">            
                        <button type="submit" class="btn btn-success mr-10 mb-30">Update Password</button>
                    </div>              
                </form>
                
            </div> 
        </div><!-- /.container-fluid -->
    </section>
    @endsection 

