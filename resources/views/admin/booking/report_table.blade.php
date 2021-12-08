 
	<table class="table table-bordered" id="report_table">
		<thead style="background-color: #605f6a;color: #fff">
			<tr>
				<th>Booking typ</th>
				<th>Booking date</th>
				<th>Trip Date</th>
				<th>Adults</th>
				<th>Children</th> 
			</tr>
		</thead>
		<tbody>
			@foreach ($bookings as $bookings)
			<tr>
				<td>{{ $bookings->booking_type_id }}</td>
				<td>{{ $bookings->booking_date }}</td>
				<td>{{ $bookings->trip_date }}</td>
				<td>{{ $bookings->adults }}</td>
				<td>{{ $bookings->children }}</td>
			</tr> 
			@endforeach 
				 
		</tbody>
	</table> 