
<div class="row">
              <table>
                <thead>
                  <tr class="">
                    <th  style="width:100%"><legend> Approved Requests </legend> </th>
<th ><a  href="/yo/po" class="btn btn-info" style="align:right">Export to Excel</a></th>
</tr>

</thead>
</table>
        <table class="table table-hover table table-light">
  <thead >
    <tr>
      <th scope="col">Transaction ID</th>
      <!-- <th scope="col">User ID</th> -->
      <th scope="col">Product Name</th>
      <th scope="col">User Name</th>
      <!-- <th scope="col">Product Name</th> -->
      <!-- <th scope="col">Description</th> -->
      <!-- <th scope="col">Start Date</th> -->
      <!-- <th scope="col">End Date</th> -->
      <th scope="col">Details</th>
      <th scope="col">Action</th>



    </tr>
  </thead>
  <tbody>
    @if(count($articles)>0)
      @foreach($articles as $article)

      <td> {{ $article->booking_id}}</td>
      <!-- <td>{{$article->user_id}}</td> -->
      <td>{{$article->productname}}</td>
      <td>{{$article->username}}</td>

      <!-- <td>{{$article->booking_reason}}</td> -->
      <!-- <td>{{$article->start_date}}</td> -->
      <!-- <td>{{$article->end_date}}</td> -->
      <td>


<button type="button" class="btn btn-primary " data-toggle="modal" data-target={{'#'.$article->booking_id}}>
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
               <form role="form" method="POST" action="">
                   <input type="hidden" name="_token" value="">
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
                           <input type="text" class="form-control input-lg" name="{{$article->booking_reason}}" readonly>
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
                           <input type="text" class="form-control input-lg" name="" value="{{$article->start_date}}" readonly>
                       </div>
                   </div>
                   <div class="form-group">
                       <label class="control-label">End_Date</label>
                       <div>
                           <input type="text" class="form-control input-lg" name="" value="{{$article->end_date}}" readonly>
                       </div>
                   </div>
                   <div class="form-group">
                       <label class="control-label">Comments</label>
                       <div>
                           <input type="text" class="form-control input-lg" name="" value="{{$article->comment}}" readonly>
                       </div>
                   </div>
                   <div class="form-group">
                       <div>
                           <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                       </div>
                   </div>
               </form>
           </div>
       </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

      </td>

      <td>

        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
          <!-- <span class="glyphicon glyphicon-remove"></span> -->

          Decline
        </button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Give a Reason</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>
        <div class="modal-body">

<div class="form-group">
  <form method="GET" action="{{ url('dec/but/')}}" >
    <label for="reason">Reason</label>
    <textarea class="form-control" name ="reason" id="ex" rows="3"></textarea>

    <input type="hidden" name="booking_id" value="{{$article->booking_id}}">
  <!-- </div> -->


        {{ csrf_field() }}

 <button type="submit" class="btn btn-primary">Submit</button>

</form>
        </div>

      </div>

    </div>
  </div>

      </td>




    </tr>
    @endforeach
     @endif
    </tbody>
</table>
<!-- <a href="yo/po" class="btn btn-primary">Export to Excel</a> -->
</div>
