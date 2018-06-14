<h3>Hey,</h3>
<p> Your request has been approved. Please find details in below</p>
<p></p>
<table border="1">
  <thead>
    <tr>
      <th>Product Name</th>
      <th>Start_Date</th>
      <th>End_Date</th>
      <th>Comments</th>
    </tr>
  </thead>

  <tbody>
  @foreach($array as $ct)
    <tr>

      <td>{{$ct->productname}}</td>
      <td>{{$ct->start_date}}</td>
      <td>{{$ct->end_date}}</td>
      <td>{{$ct->comment}}</td>
    </tr>
  @endforeach
  </tbody>

</table>
<br>

Regards,
<br>
NUIGsocs Inventory Booking.
