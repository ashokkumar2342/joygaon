@extends('admin.layout.base')
@section('body')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Booking</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right"> 
                </ol>
            </div>
        </div> 
        <div class="card card-info"> 
            <div class="card-body">
                <form action="{{ route('payment.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="row"> 
                        <div class="col-lg-6 form-group"> 
                            <label for="exampleInputEmail1">Booking Type</label>
                            <span class="fa fa-asterisk"></span>
                            <select class="form-control" name="booking_type" id="booking_type" required onchange="amontAdd()">
                            @foreach ($bookingTypes as $bookingType)
                                <option value="{{$bookingType->id}}">{{$bookingType->code}}-{{$bookingType->name}}</option>
                            @endforeach 
                             </select>                    
                        <p class="text-danger">{{ $errors->first('booking_type') }}</p>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>Booking Date</label>
                            <span class="fa fa-asterisk"></span> 
                            <input type="date" name="booking_date" class="form-control" id="exampleInputEmail1" maxlength="50" min="{{ date('Y-m-d',strtotime(date('d-m-Y'))) }}" required> 
                        <p class="text-danger">{{ $errors->first('booking_date') }}</p> 
                        </div>
                        <div class="col-lg-3 form-group">
                            <label>Adults</label>
                            <span class="fa fa-asterisk"></span> 
                            <input type="text" name="adults" class="form-control section" id="adult_div" maxlength="3" onkeyup="amontAdd()" value="0" required> 
                        <p class="text-danger">{{ $errors->first('adults') }}</p> 
                        </div>
                        <div class="col-lg-3 form-group">
                            <label>Children</label>
                            <span class="fa fa-asterisk"></span> 
                            <input type="text" name="children" class="form-control section" id="children_div" maxlength="3" onkeyup="amontAdd()" value="0"> 
                        <p class="text-danger">{{ $errors->first('children') }}</p>
                        </div>
                        <div class="col-lg-3 form-group">
                            <label>Team Leader Name</label>
                            <span class="fa fa-asterisk"></span> 
                            <input type="text" name="team_leader_name" class="form-control" id="exampleInputEmail1" maxlength="50" required> 
                        <p class="text-danger">{{ $errors->first('team_leader_name') }}</p>
                        </div>
                        <div class="col-lg-3 form-group">
                            <label>Leader Mobile No.</label>
                            <span class="fa fa-asterisk"></span> 
                            <input type="text" name="leader_mobile_no" class="form-control" id="exampleInputEmail1"maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required> 
                        <p class="text-danger">{{ $errors->first('leader_mobile_no') }}</p> 
                        </div>
                        <div class="col-lg-4 form-group" style="margin-top: 30px"> 
                            <div class="card bg-gray"> 
                              <div class="form-group clearfix">
                                <div class="icheck-primary d-inline"> 
                                  <input type="text" name="total_amount"  id="total_amount_hidden">
                                  <span style="margin: 15px"> Total Amount : <b><span id="total_amount_show"> 0</span></b></span>
                                </div> 
                              </div>
                            </div> 
                        </div>
                        <div class="col-lg-8 form-group" style="margin-top: 30px">
                          <input type="submit" class="form-control btn btn-info" value="Booking">
                        </div>   
                    </div>
                     
              </form>  
            </div> 
        </div>
    </section>
    @endsection
@push('scripts')
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <script>
     var totalPoints = 0;
    function amontAdd() {
        booking_type = $('#booking_type').val();
        ad_am =0;
        if(booking_type==1){
            ad_am ={{ $t1_ad_amount }}; 
        }if(booking_type==2){
            ad_am ={{ $t2_ad_amount }}; 
        }if(booking_type==3){
            ad_am ={{ $t3_ad_amount }}; 
        }
        ch_am =0;
        if(booking_type==1){
            ch_am ={{$t1_ch_amount}}; 
        }if(booking_type==2){
            ch_am ={{$t2_ch_amount}}; 
        }if(booking_type==3){
            ch_am ={{$t3_ch_amount}}; 
        }

        adult_div = parseInt($('#adult_div').val());
        adult_div = adult_div * ad_am;

        children_div = parseInt($('#children_div').val());
        children_div = children_div * ch_am;
        totalPoints = adult_div+children_div;

        $('#total_amount_show').html(totalPoints);
        $('#total_amount_hidden').val(totalPoints);
          console.log(totalPoints);
    }
       
   </script>
@endpush 

