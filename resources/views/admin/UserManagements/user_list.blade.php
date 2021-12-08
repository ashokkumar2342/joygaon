@extends('admin.layout.base')
@section('body')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>User Lists</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right"> 
                </ol>
            </div>
        </div> 
        <div class="card card-info"> 
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Name</th>
                            <th>Email ID</th>
                            <th>Mobile No.</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userlists as $userlists)
                        <tr>
                            <td>{{$userlists->name}}</td>
                            <td>{{$userlists->email_id}}</td>
                            <td>{{$userlists->mobile_no}}</td>
                            <td>
                                <a href="" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                                <a href="" class="btn btn-xs btn-info">Active</a>
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody> 
                </table> 
            </div> 
        </div><!-- /.container-fluid -->
    </section>
    @endsection 

