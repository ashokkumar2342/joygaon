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
        <td style="padding-left: 800px;padding-top:170px"><b>{{$bivents_booking_type[0]->name}}</b></td> 
      </tr>
      <tr>
        <td style="padding-left: 826px;padding-top:5px"><b>{{$booking_id[0]->id}}</b></td> 
      </tr>
      <tr>
        <td style="padding-left: 745px;padding-top:50px"><barcode code="{{$booking_id[0]->id}}" height="1.8" type="C39" size = "0.8" class="barcode"/></td> 
      </tr>
      <tr>
        <td style="padding-left: 110px;padding-top:-70px"><b>{{$bivents_booking_type[0]->name}}</b></td> 
      </tr>
      <tr>
        <td style="padding-left: 140px;padding-top:-20px"><b>{{$booking_id[0]->id}}</b></td> 
      </tr>
      </table> 
    </div> 
</body>
</html>