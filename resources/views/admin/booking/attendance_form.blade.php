<div class="row">
	<div class="col-lg-6">
		<div class="card card-gray">
			<div class="card-header">
	     		<h3 class="card-title">Total</h3>
	    	</div>
		<table class="table table-bordered">
			<thead class="thead-dark">
				<tr>
					<th>Ticket No.</th>
					<th>Adults</th>
					<th>Children</th>
					<th>Booking Date</th>
					<th>Amount</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($bookings as $booking)
				<tr>
					<td>{{$booking->id}}</td>
					<input type="hidden" name="booking_id" value="{{$booking->id}}" class="hidden">
					<td>{{$booking->adults}}</td>
					<td>{{$booking->children}}</td>
					<td>{{$booking->booking_date}}</td>
					<td>{{$booking->amount}}</td>
				</tr>
				@endforeach
			</tbody> 
		</table>
	</div>
	</div>
	<div class="col-lg-6">
		<div class="card card-gray">
			<div class="card-header">
	     		<h3 class="card-title">Present</h3>
	    	</div>
		<table class="table table-bordered">
			<thead class="thead-dark">
				<tr>
					<th>Ticket No.</th>
					<th>Adults</th>
					<th>Children</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($checkin_details as $checkin_detail)
				<tr>
					<td>{{$checkin_detail->booking_id}}</td> 
					<td>{{$checkin_detail->adults_count}}</td>
					<td>{{$checkin_detail->children_count}}</td>
					
				</tr>
				@endforeach
			</tbody> 
		</table>
	</div>
	</div> 
	<div class="col-lg-4 form-group">
		<label>Adults</label>
		<input type="text" name="adults_count" class="form-control" maxlength="3" value="0" onkeypress='return event.charCode >= 48 && event.charCode <= 57'> 
	</div>
	<div class="col-lg-4 form-group">
		<label>Children</label>
		<input type="text" name="children_count" class="form-control" maxlength="3" value="0" onkeypress='return event.charCode >= 48 && event.charCode <= 57'> 
	</div>
	
	<div class="col-lg-4 form-group"> 
		<input type="submit" class="form-control btn btn-info" value="Save" style="margin-top: 30px"> 
	</div> 
</div> 
