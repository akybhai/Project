<h3>Hey,</h3>

<p>There is a new Request from {{$name}}.</p>
<b>Reason: </b>
  "{{$reason}}"


<p><br>
<table border="1">
  <thead>
    <tr>
      <th>Product ID</th>
      <th>Product Name</th>
      <th>From</th>
      <th>To</th>
    </tr>
  </thead>
  <tbody>
    @foreach($cart as $ct)
      <tr>

        <td>{{$ct->Product_Id}}</td>
        <td><?php
echo DB::table('products')->where('productID',$ct->Product_Id )->pluck('name')[0];
        ?></td>
        <td>{{$ct->Start_Date}}</td>
        <td>{{$ct->End_Date}}</td>
      </tr>
    @endforeach
  </tbody>
</table>
<br>
</p>
Regards,
<br>
NUIGsocs Inventory Booking.
