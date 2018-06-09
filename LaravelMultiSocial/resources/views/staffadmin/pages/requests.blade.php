@extends('staffadmin.layouts.app')

@section('admincontent')

<div class="bs-component" style="margin-bottom: 15px;">
       <div class="btn-group btn-group-toggle" data-toggle="buttons">
         <label class="btn btn-outline-info active btn-lg" onclick="pendingfunction()">
           <input id="option1" type="radio" name="options" autocomplete="off" checked=""> Pending
         </label>
         <label class="btn btn-outline-info btn-lg" onclick="approvedfunction()">
           <input id="option2" type="radio" name="options" autocomplete="off" > Approved
         </label>
         <label class="btn btn-outline-info btn-lg" onclick="declinedfunction()">
           <input id="option3" type="radio" name="options" autocomplete="off"> Declined
         </label>
       </div>
     </div>
     <script type="text/javascript">
         function pendingfunction(){
             document.location.reload(true);
         }
     </script>
<div class="container" id="statusTables">
  <div class="row">

    <table  >
      <thead>
        <tr class="">
  <th style="width:100%"><legend> Pending Requests </legend> </th>
  <th> </th>

</tr>

</thead>
</table>

        <table class="table table-hover table table-light">
  <thead >
    <tr>
      <th scope="col">Transaction ID</th>

      <th scope="col">Product Name</th>
      <th scope="col">User Name</th>

      <th scope="col">Details</th>

   </tr>
  </thead>

  <tbody>
    <!-- {{count($articles)}} -->
    <!-- {{$articles}} -->

    @if(count($articles)>0)
      @foreach($articles as $article)
      <td> {{$article->booking_id}}</td>
      <!-- <td>{{$article->user_id}}</td> -->
      <td>{{$article->productname}}</td>
      <td>{{$article->username}}</td>




      <td>


  <button type="button" class="btn btn-primary "  data-toggle="modal" data-target={{'#'.$article->booking_id}}>
    <!-- <span class="glyphicon glyphicon-eye-open"></span> -->
  View
  </button>



  <!-- Modal HTML Markup -->
  <div id={{$article->booking_id}} class="modal fade">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h1 class="modal-title">Transaction Details</h1>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
        </button>
           </div>
           <div class="modal-body">
               <form role="form" method="POST" action="{{url('apvdec/but/'.$article->booking_id)}}">
                   <input type="hidden" name="_token" value="">
                   {{ csrf_field() }}
                   <div class="form-group">
                       <label class="control-label">Transaction_ID</label>
                       <div>
                           <input type="text" class="form-control input-lg" name="" value="{{$article->booking_id}}" readonly>
                       </div>
                   </div>
                   <div class="form-group">
                       <label class="control-label">User_ID</label>
                       <div>
                           <input type="text" class="form-control input-lg" name="" value="{{$article->user_id}}" readonly>
                       </div>
                   </div>


                   <div class="form-group">
                       <label class="control-label">User Name</label>
                       <div>
                           <input type="text" class="form-control input-lg" name="name" value="{{$article->username}}" readonly>
                       </div>
                   </div>
                   <div class="form-group">
                       <label class="control-label">Product_ID</label>
                       <div>
                           <input type="text" class="form-control input-lg" name="" value="{{$article->product_id}}" readonly>
                       </div>
                   </div>
                   <div class="form-group">
                       <label class="control-label">Product_Name</label>
                       <div>
                           <input type="text" class="form-control input-lg" name="" value="{{$article->productname}}" readonly>
                       </div>
                   </div>
                   <div class="form-group">
                       <label class="control-label">Booking_Reason</label>
                       <div>
                           <input type="text" class="form-control input-lg" name="" value="{{$article->booking_reason}}" readonly>
                       </div>
                   </div>
                   <div class="form-group">
                       <label class="control-label">User's Contact No</label>
                       <div>
                           <input type="text" class="form-control input-lg" name="" value="{{$article->mobile}}" readonly>
                       </div>
                   </div>
                   <div class="form-group">
                       <label class="control-label">Start_Date</label>
                       <div>

                           <input type="datetime-local" class="form-control input-lg" name="startdate" value="<?php
                           $date = new DateTime($article->start_date);
                           echo $date->format('Y-m-d');

                           echo 'T';

                           $time=new DateTime($article->start_date);

                           echo $time->format('H:i');

                           ?>"  >
                       </div>
                   </div>
                   <div class="form-group">
                       <label class="control-label">End_Date</label>
                       <div>
                           <input type="datetime-local" class="form-control input-lg" name="enddate" value="<?php
                           $date = new DateTime($article->end_date);
                           echo $date->format('Y-m-d');

                           echo 'T';

                           $time=new DateTime($article->end_date);

                           echo $time->format('H:i');

                           ?>"  >
                       </div>
                   </div>
                   <div class="form-group">
                       <label class="control-label">Comments</label>
                       <div>
                           <input type="text" class="form-control input-lg" name="comment" value="{{$article->reject_comment}}" required >
                       </div>
                   </div>
                   <div class="form-group">
                       <div>
                           <button type="submit" class="btn btn-primary" name="action" value="approve">Approve</button>
                           <button type="submit" class="btn btn-danger" name="action" value="decline">Decline</button>
                       </div>
                   </div>
               </form>
           </div>
       </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

      </td>

    </tr>

    @endforeach
     @endif
    </tbody>
  </table>
      </div>

      </div>





@endsection
@section('script')
<script type="text/javascript">
  function approvedfunction()
  {
    // console.log("it works");
    // $('#searchBtn').click(function(){
  // get the value of the input field
  // $value=$('#searchbox').val();
  //check the input field then only fire ajax call
  // if($value)
  // {
    $.ajax({
    type : 'get',
    url : '{{route('adminstaff.request.approved')}}',
    data:{'search': "1"},
    success:function(data){
      console.log(data);
    $('#statusTables').empty().html(data);
    }
    });
  // }
  // else
  // {
  //   // send an alert to input a value
  //   alert('enter the search parameter');
  // }


// });
  }

  function declinedfunction()
  {
    // console.log("it works");
    // $('#searchBtn').click(function(){
  // get the value of the input field
  // $value=$('#searchbox').val();
  //check the input field then only fire ajax call
  // if($value)
  // {
    $.ajax({
    type : 'get',
    url : '{{route('adminstaff.request.declined')}}',
    data:{'search': "1"},
    success:function(data){
      console.log(data);
    $('#statusTables').empty().html(data);
    }
    });

  }



</script>
@endsection
