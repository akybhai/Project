<h3>Hey,</h3>

<p>There is a new Request from {{$name}}.</p>


<!--

'USER_ID' => $c['userId'], 'Product_ID' => $c['productID'], 'START_DATE' => $c['startDate'],
 'END_DATE' => $c['endDate'], 'BOOKING_STATUS' => 'approved',
  'BOOKING_REASON' => $c['bookingReason']

-->
<p><br>
<table border="1">
  <thead>
    <tr>
      <th>User ID</th>
      <th>Product ID</th>
      <th>From</th>
      <th>To</th>
    </tr>
  </thead>
  <tbody>
    @foreach($cart as $c)
      <tr>
        <td>{{ $c['userId'] }}</td>
        <td>{{ $c['productID'] }}</td>
        <td>{{ $c['startDate'] }}</td>
        <td>{{ $c['endDate']  }}</td>
        <td>{{ $c['bookingReason'] }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
<br>
</p>
Regards,
<br>
NUIGsocs Inventory Booking.
