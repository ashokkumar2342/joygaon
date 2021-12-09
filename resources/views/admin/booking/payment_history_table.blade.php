 
	<table class="table table-bordered" id="payment_his_table">
		<thead style="background-color: #605f6a;color: #fff">
			<tr>
				<th>Order Id</th>
				<th>Booking typ</th>
				<th>Booking date</th>
				<th>Trip Date</th>
				<th>Adults</th>
				<th>Children</th> 
				<th>Total Amount</th> 
				<th>Status</th> 
			</tr>
		</thead>
		<tbody>
			@foreach ($bookings as $bookings)
			@php
			    if($bookings->status==0){
			        $color='bg-warning';
			        $status='Payment Pending';
			    }elseif($bookings->status==1){
			        $color='bg-success';
			        $status='Payment Success';
			    }
			@endphp
			<tr class="{{$color}}">
				<td>{{ $bookings->order_id }}</td>
				<td>{{ $bookings->booking_type_id }}</td>
				<td>{{ $bookings->booking_date }}</td>
				<td>{{ $bookings->trip_date }}</td>
				<td>{{ $bookings->adults }}</td>
				<td>{{ $bookings->children }}</td>
				<td>{{ $bookings->amount }}</td>
				<td>{{$status}}</td>
				

			</tr> 
			@endforeach 
				 
		</tbody>
	</table> 