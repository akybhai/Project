@extends('layouts.app')
@section('content')

</br>


<div class="container">
     <div class="row">
       <legend> Pending Requests </legend>
   <table class="table table-hover">
     <thead>
       <tr>
         <th scope="col">Booking_ID</th>
         <th scope="col">Product_ID</th>
         <th scope="col">Product_Name</th>
         <th scope="col">Booking Reason</th>

         <th scope="col">Start_Date</th>
         <th scope="col">End Date</th>
         <th scope="col">Booking_Status</th>
       </tr>
     </thead>
     <tbody>
       <tr>

         <td>656545</td>
         <td>6566666</td>
         <td>Camera</td>
         <td>I need</td>

         <td>13-12-2017</td>
         <td>14-01-2018</td>
         <td>Pending</td>
       </tr>

     </tbody>
   </table>

</div>
</div>

<div class="container">
 <div class="row">
   <legend> Approved Requests </legend>
<table class="table table-hover">
 <thead>
   <tr>
     <th scope="col">Booking_ID</th>
     <th scope="col">Product_ID</th>
     <th scope="col">Product_Name</th>
     <th scope="col">Booking Reason</th>

     <th scope="col">Start_Date</th>
     <th scope="col">End Date</th>
     <th scope="col">Booking_Status</th>
     <th scope="col">Return_Date</th>
   </tr>
 </thead>
 <tbody>
   <tr>
     <td>65656</td>
     <td>261251212</td>
     <td>Mic</td>
     <td>Neded for pre</td>

     <td>12-02-2018</td>
     <td>15-02-2018</td>
     <td>Approved</td>
     <td>16-02-2018</td>
   </tr>

 </tbody>
</table>

</div>
</div>

<div class="container">
 <div class="row">
   <legend> Declined Requests </legend>
<table class="table table-hover">
 <thead>
   <tr>
     <th scope="col">Booking_ID</th>
     <th scope="col">Product_ID</th>
     <th scope="col">Product_Name</th>
     <th scope="col">Booking Reason</th>

     <th scope="col">Start_Date</th>
     <th scope="col">End Date</th>
     <th scope="col">Booking_Status</th>
     <th scope="col">Return_Date</th>
     <th scope="col">Reject_Comment</th>
   </tr>
 </thead>
 <tbody>
   <tr>
     <td>655151515t</td>
     <td>65484515</td>
     <td>Board</td>
     <td>need......</td>
     <td>15-01-2018</td>
     <td>17-01-2018</td>
     <td>alll</td>
     <td>19-01-2019</td>
     <td>not available</td>
   </tr>

 </tbody>
</table>

</div>
</div>

</br>




@endsection
