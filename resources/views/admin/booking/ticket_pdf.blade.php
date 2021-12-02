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
body{
  /*color: #243;*/
  color: green; 
} 
</style>
<body>
  <div class="first"> 
    <table width = "323px">
      <tr>
        <td  style="padding-left: 10px;padding-top: 8px;"> 
          <img src="{{asset('front_asset/images/logo.png')}}" alt="" width="210px"> 
        </td>
      </tr>
      <tr>
        <td  style="padding-left: 20px;">
          <span><h3><b>Ticket No. : {{$booking_id[0]->id}}</b></h3></span>
        </td>
        <td>
          <barcode code="{{$booking_id[0]->id}}" height="0.8" type="C39" size = "0.8" class="barcode"/>
        </td>
      </tr> 
      <tr>
        <td width = "100%" style="padding-top: 8px;">
          <table width = "100%">
            <tr>
              <td style="padding-left: 20px;">
                <span><h3><b>Trip Date : </b></h3></span>
              </td>
              <td width = "">
                <span><h3><b>{{date('d-m-Y',strtotime($booking_id[0]->trip_date))}}</b></h3></span>
              </td>
            </tr>
            <tr>
              <td style="padding-left: 20px;padding-top: 10px">
                <span><h2><b>No. of Persons</b></h3></span>
              </td>
            </tr>
            <tr>
              <td style="padding-left: 20px;">
                <span><h3><b>Adult : </b></h3></span>
              </td>
              <td width = "">
                <span><h3><b>{{$booking_id[0]->adults}}</b></h3></span>
              </td>
            </tr>
            <tr>
              <td style="padding-left: 20px;">
                <span><h3><b>Children : </b></h3></span>
              </td>
              <td width = "">
                <span><h3><b>{{$booking_id[0]->children}}</b></h3></span>
              </td>
            </tr>
          </table>
          <tr>
            <td style="padding-left: 20px;padding-top: 20px">
              <span><h3><b>Address:-<br>Village Kablana, 9 Milestone, Jhajjar Bahadurgarh Road, Jhajjar, Haryana, 124104, INDIA</b></h3></span>
            </td>
            <td style="padding-left: 20px;padding-top: 50px">
              <span><h3><b>WWW.JOYGAON.IN</b></h3></span>
            </td>
              
          </tr>
        </td>
      </tr> 
    </table> 
  </div>
 

  </div>
  
</body>
</html>