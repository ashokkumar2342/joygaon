<table class="table table-bordered">
	<thead class="thead-dark">
		<tr>
			<th>Booking Type</th>
			<th>Adults</th>
			<th>Children</th>
			<th>Booking Date</th>
			<th>Amount</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($bookings as $booking)
		<tr>
			<td>{{$booking->name}}</td>
			<td>{{$booking->adults}}</td>
			<td>{{$booking->children}}</td>
			<td>{{$booking->booking_date}}</td>
			<td>{{$booking->amount}}</td>
		</tr>
		@endforeach
	</tbody> 
</table>
<div class="row">
	<div class="col-lg-3 form-group">
		<label>Adults</label>
		<input type="" name="" class="form-control"> 
	</div>
	<div class="col-lg-3 form-group">
		<label>Children</label>
		<input type="" name="" class="form-control"> 
	</div>
	<div class="col-lg-3 form-group">
		<label>Booking Date</label>
		<input type="date" name="" class="form-control"> 
	</div>
	<div class="col-lg-3 form-group"> 
		<input type="submit" class="form-control btn btn-info" value="Save" style="margin-top: 30px"> 
	</div>
	
</div>