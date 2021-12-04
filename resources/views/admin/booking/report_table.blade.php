 
	<table class="table table-bordered" id="report_table">
		<thead>
			<tr>
				<th>booking typ</th>
				<th>booking date</th>
				<th>trip_date</th>
				<th>adults</th>
				<th>children</th> 
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