@extends('admin.layout.base')
@push('links')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css">    
@endpush
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
                    <table class="table table-bordered" id="example">
                        <thead style="background-color: #605f6a;color: #fff">
                            <tr> 
                                <th>Order ID</th>
                                <th>Booking ID</th>
                                <th>Booking Date</th>
                                <th>Trip Date</th>
                                <th>Children</th>
                                <th>Adult</th>
                                @if ($user->role_id==1)
                                <th>Amount</th>
                                @endif 
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
                                    }
                                @endphp
                                <tr>
                                    <td>{{$rr_list->order_id}}</td>
                                    <td>{{$rr_list->id}}</td>
                                    <td>{{date('d-m-Y',strtotime($rr_list->booking_date))}}</td>
                                    <td>{{date('d-m-Y',strtotime($rr_list->trip_date))}}</td>
                                    <td>{{$rr_list->children}}</td>
                                    <td>{{$rr_list->adults}}</td>
                                    @if ($user->role_id==1)
                                    <td>{{$rr_list->amount}}</td>
                                    @endif 
                                    
                                    <td class="{{$color}}">{{$status}}</td>
                                    <td>
                                    
                                        @if ($rr_list->status==0)
                                            <a href="{{ route('admin.pay.again',Crypt::encrypt($rr_list->id)) }}" class="btn btn-xs btn-info">PAY Again</a>
                                        @endif
                                        @if ($rr_list->status==1) 
                                            <a href="{{ route('admin.download.ticket',Crypt::encrypt($rr_list->order_id)) }}" class="btn btn-xs btn-success" target="_blank" > <i class="fa fa-download"></i> Download Ticket</a>
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
<script type="text/javascript" src="//code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>

<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.html5.min.js"></script>
<script type='text/javascript' src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
        "ordering": false,
        'paging':   false,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]

    } );
} );
   </script>
</script> 
@endpush

