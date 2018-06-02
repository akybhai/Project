@extends('layouts.app')
@section('content')

</br>


<div class="container">
     <div class="row">
       <legend> Pending Requests </legend>
   <table class="table table-hover">
     <thead>
       <tr>
         <th scope="col">Transaction_ID</th>
         <th scope="col">Product_ID</th>
         <!-- <th scope="col">Product_Name</th> -->
         <!-- <th scope="col">Booking Reason</th> -->

         <th scope="col">Start_Date</th>
         <th scope="col">End Date</th>
         <th scope="col">Booking_Status</th>
       </tr>
     </thead>
     <tbody>
       @if(count($getData)>0)
         @foreach($getData as $gtd)

       <tr>

         <td>{{$gtd->booking_id}}</td>

         <td>{{$gtd->product_id}}</td>
         <td>{{$gtd->start_date}}</td>


         <td>{{$gtd->end_date}}</td>
         <td>{{$gtd->booking_status}}</td>
         <!-- <td>{{$gtd->booking_id}}</td> -->
       </tr>

       @endforeach
       @endif
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
     <th scope="col">Transaction_ID</th>
     <th scope="col">Product_ID</th>
     <!-- <th scope="col">Product_Name</th> -->
     <!-- <th scope="col">Booking Reason</th> -->

     <th scope="col">Start_Date</th>
     <th scope="col">End Date</th>
     <th scope="col">Booking_Status</th>
     <!-- <th scope="col">Return_Date</th> -->
   </tr>
 </thead>
 <tbody>
   @if(count($getDataa)>0)
     @foreach($getDataa as $gtd)
   <tr>
     <td>{{$gtd->booking_id}}</td>

     <td>{{$gtd->product_id}}</td>
     <td>{{$gtd->start_date}}</td>


     <td>{{$gtd->end_date}}</td>
     <td>{{$gtd->booking_status}}</td>

   </tr>
   @endforeach
   @endif
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
     <th scope="col">Transaction_ID</th>
     <th scope="col">Product_ID</th>
     <!-- <th scope="col">Product_Name</th> -->
     <!-- <th scope="col">Booking Reason</th> -->

     <th scope="col">Start_Date</th>
     <th scope="col">End Date</th>
     <th scope="col">Booking_Status</th>

   </tr>
 </thead>
 <tbody>

   @if(count($getDataaa)>0)
     @foreach($getDataaa as $gtd)
   <tr>
     <td>{{$gtd->booking_id}}</td>

     <td>{{$gtd->product_id}}</td>
     <td>{{$gtd->start_date}}</td>


     <td>{{$gtd->end_date}}</td>
     <td>{{$gtd->booking_status}}</td>

   </tr>
   @endforeach
   @endif
 </tbody>
</table>

</div>
</div>

</br>




@endsection
