

<div class="row">
              <table >
                <thead>
                  <tr class="">
                    <th style="width:100%"><legend> Declined Requests </legend> </th>
<th><a href="/zo/qo" class="btn btn-info" style="align:Right">Export to Excel</a></th>
</tr>

</thead>
</table>
        <table class="table table-hover table table-light" >
  <thead >
    <tr>
      <th scope="col">Transaction ID</th>
      <!-- <th scope="col">User ID</th> -->
      <!-- <th scope="col">Product ID</th> -->
      <th scope="col">User Name</th>
      <!-- <th scope="col">Mobile</th> -->
      <!-- <th scope="col">Description</th> -->
      <!-- <th scope="col">Start Date</th> -->
      <!-- <th scope="col">End Date</th> -->
      <th scope="col">Product Name</th>

      <th scope="col">Details</th>


    </tr>
  </thead>
  <tbody >


  <!-- {{$articles}} -->
  @foreach( $articles as $art)
  <tr>


  <td>{{ $art->booking_id }}</td>
  <!-- <td>{{ $art->product_id  }}</td> -->
  <td>{{ $art->username    }}</td>
  <td>{{ $art->productname }}</td>

  <td>
    <button type="button" class="btn btn-primary " data-toggle="modal" data-target={{'#'.$art->booking_id}}>
      <!-- <span class="glyphicon glyphicon-eye-open"></span> -->
      View
    </button>

    <!-- Modal HTML Markup -->

    <div id={{$art->booking_id}} class="modal fade">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h1 class="modal-title">Transaction Details</h1>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
            </button>
               </div>
               <div class="modal-body">
                   <form role="form" method="POST" action="">
                       <input type="hidden" name="_token" value="">
                       <div class="form-group">
                           <label class="control-label">Transaction_ID</label>
                           <div>
                               <input type="text" class="form-control input-lg" name="" value="{{$art->booking_id}}" readonly>
                           </div>
                       </div>
                       <div class="form-group">
                           <label class="control-label">User_ID</label>
                           <div>
                               <input type="text" class="form-control input-lg" name="" value="{{$art->user_id}}" readonly>
                           </div>
                       </div>


                       <div class="form-group">
                           <label class="control-label">User Name</label>
                           <div>
                               <input type="text" class="form-control input-lg" name="name" value="{{$art->username}}" readonly>
                           </div>
                       </div>
                       <div class="form-group">
                           <label class="control-label">Product_ID</label>
                           <div>
                               <input type="text" class="form-control input-lg" name="" value="{{$art->product_id}}" readonly>
                           </div>
                       </div>
                       <div class="form-group">
                           <label class="control-label">Product_Name</label>
                           <div>
                               <input type="text" class="form-control input-lg" name="" value="{{$art->productname}}" readonly>
                           </div>
                       </div>
                       <div class="form-group">
                           <label class="control-label">Booking_Reason</label>
                           <div>
                               <input type="text" class="form-control input-lg" name="" value="{{$art->booking_reason}}" readonly>
                           </div>
                       </div>
                       <div class="form-group">
                           <label class="control-label">User's Contact No</label>
                           <div>
                               <input type="text" class="form-control input-lg" name="" value="{{$art->mobile}}" readonly>
                           </div>
                       </div>
                       <div class="form-group">
                           <label class="control-label">Start_Date</label>
                           <div>
                               <input type="text" class="form-control input-lg" name="" value="{{$art->start_date}}" readonly>
                           </div>
                       </div>
                       <div class="form-group">
                           <label class="control-label">End_Date</label>
                           <div>
                               <input type="text" class="form-control input-lg" name="" value="{{$art->end_date}}" readonly>
                           </div>
                       </div>
                       <div class="form-group">
                           <label class="control-label">Comments</label>
                           <div>
                               <input type="text" class="form-control input-lg" name="" value="{{$art->comment}}" readonly>
                           </div>
                       </div>
                       <div class="form-group">
                           <div>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                               </button>
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
    </tbody>
</table>
<!-- <a href="zo/qo" class="btn btn-primary">Export to Excel</a> -->
      </div>
