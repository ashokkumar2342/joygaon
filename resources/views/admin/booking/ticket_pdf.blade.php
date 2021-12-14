<!DOCTYPE html>
<html>
<head>
  <title>Ticket Print</title>
</head>
<style type="text/css">
  @page{margin:0;} 
  @page first{
    background-image: url('{{$bimage1}}');
    background-repeat:no-repeat;
    margin-top:0px;
    margin-bottom:0px;
    background-image-resize:6;
    } 
div.first{
  page:first; 
}
table ,td{
  color: #e2e9e114;
}
</style>
<body>
  <div class="first"> 
    <table> 
      <tr>
        <td style="padding-left: 470px;padding-top:6px;"><b>{{$booking_id[0]->id}}</b></td> 
      </tr>
      <tr>
        <td style="padding-left: 356px;padding-top:7px"><barcode code="{{$booking_id[0]->id}}" height="0.8" type="C39" size = "1.0" class="barcode"/></td> 
      </tr>
      <tr>
        <td style="padding-left:100px;padding-top:72px"><b>{{$booking_id[0]->person_name}}</b></td> 
      </tr>
      <tr>
        <td style="padding-left:154px;padding-top:-3px"><b>{{$booking_id[0]->mobile_no}}</b></td> 
      </tr>
      <tr>
        <td style="padding-left:110px;padding-top:-3px"><b>{{$booking_id[0]->adults}}</b></td> 
      </tr> 
      <tr>
        <td style="padding-left:137px;padding-top:-3px"><b>{{$booking_id[0]->children}}</b></td> 
      </tr>
      <tr>
        <td style="padding-left:180px;padding-top:62px;font-size: 20px"><b>Trip Date : {{date('d-m-Y',strtotime($booking_id[0]->trip_date))}}</b></td> 
      </tr> 
      </table> 
    </div> 
</body>
</html>