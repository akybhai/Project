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
         <!-- <th scope="col">Product_ID</th> -->
         <!-- <th scope="col">Product_Name</th> -->
         <!-- <th scope="col">Booking Reason</th> -->

         <!-- <th scope="col">Start_Date</th>
         <th scope="col">End Date</th> -->
         <th scope="col">Booking_Status</th>
         <th scope="col">Details</th>
       </tr>
     </thead>
     <tbody>
       @if(count($getData)>0)
         @foreach($getData as $gtd)

       <tr>

         <td>{{$gtd->booking_id}}</td>

         <!-- <td>{{$gtd->product_id}}</td>
         <td>{{$gtd->start_date}}</td>


         <td>{{$gtd->end_date}}</td> -->
         <td>{{$gtd->booking_status}}</td>

         <td>
           <button type="button" class="btn btn-primary " data-toggle="modal" data-target={{'#'.$gtd->booking_id}}>
             <!-- <span class="glyphicon glyphicon-eye-open"></span> -->
             View
           </button>

           <!-- Modal HTML Markup -->

           <div id={{$gtd->booking_id}} class="modal fade">
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
                                      <input type="text" class="form-control input-lg" name="" value="{{$gtd->booking_id}}" readonly>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label">User_ID</label>
                                  <div>
                                      <input type="text" class="form-control input-lg" name="" value="{{$gtd->user_id}}" readonly>
                                  </div>
                              </div>



                              <div class="form-group">
                                  <label class="control-label">Product_ID</label>
                                  <div>
                                      <input type="text" class="form-control input-lg" name="" value="{{$gtd->product_id}}" readonly>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label">Booking_Reason</label>
                                  <div>
                                      <input type="text" class="form-control input-lg" name="" value="{{$gtd->booking_reason}}" readonly>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label">Start_Date</label>
                                  <div>
                                      <input type="text" class="form-control input-lg" name="" value="{{$gtd->start_date}}" readonly>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label">End_Date</label>
                                  <div>
                                      <input type="text" class="form-control input-lg" name="" value="{{$gtd->end_date}}" readonly>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label">Comments</label>
                                  <div>
                                      <input type="text" class="form-control input-lg" name="" value="{{$gtd->comment}}" readonly>
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
     <!-- <th scope="col">Product_ID</th> -->
     <!-- <th scope="col">Product_Name</th> -->
     <!-- <th scope="col">Booking Reason</th> -->

     <!-- <th scope="col">Start_Date</th>
     <th scope="col">End Date</th> -->
     <th scope="col">Booking_Status</th>
     <th scope="col">Details</th>
     <!-- <th scope="col">Return_Date</th> -->
   </tr>
 </thead>
 <tbody>
   @if(count($getDataa)>0)
     @foreach($getDataa as $gtd)
   <tr>
     <td>{{$gtd->booking_id}}</td>

     <!-- <td>{{$gtd->product_id}}</td>
     <td>{{$gtd->start_date}}</td>


     <td>{{$gtd->end_date}}</td> -->
     <td>{{$gtd->booking_status}}</td>

     <td>
       <button type="button" class="btn btn-primary " data-toggle="modal" data-target={{'#'.$gtd->booking_id}}>
         <!-- <span class="glyphicon glyphicon-eye-open"></span> -->
         View
       </button>

       <!-- Modal HTML Markup -->

       <div id={{$gtd->booking_id}} class="modal fade">
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
                                  <input type="text" class="form-control input-lg" name="" value="{{$gtd->booking_id}}" readonly>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label">User_ID</label>
                              <div>
                                  <input type="text" class="form-control input-lg" name="" value="{{$gtd->user_id}}" readonly>
                              </div>
                          </div>



                          <div class="form-group">
                              <label class="control-label">Product_ID</label>
                              <div>
                                  <input type="text" class="form-control input-lg" name="" value="{{$gtd->product_id}}" readonly>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="control-label">Booking_Reason</label>
                              <div>
                                  <input type="text" class="form-control input-lg" name="" value="{{$gtd->booking_reason}}" readonly>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="control-label">Start_Date</label>
                              <div>
                                  <input type="text" class="form-control input-lg" name="" value="{{$gtd->start_date}}" readonly>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label">End_Date</label>
                              <div>
                                  <input type="text" class="form-control input-lg" name="" value="{{$gtd->end_date}}" readonly>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label">Comments</label>
                              <div>
                                  <input type="text" class="form-control input-lg" name="" value="{{$gtd->comment}}" readonly>
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
     <!-- <th scope="col">Product_ID</th> -->
     <!-- <th scope="col">Product_Name</th> -->
     <!-- <th scope="col">Booking Reason</th> -->

     <!-- <th scope="col">Start_Date</th>
     <th scope="col">End Date</th> -->
     <th scope="col">Booking_Status</th>
     <th scope="col">Details</th>

   </tr>
 </thead>
 <tbody>

   @if(count($getDataaa)>0)
     @foreach($getDataaa as $gtd)
   <tr>
     <td>{{$gtd->booking_id}}</td>

     <!-- <td>{{$gtd->product_id}}</td>
     <td>{{$gtd->start_date}}</td>


     <td>{{$gtd->end_date}}</td> -->
     <td>{{$gtd->booking_status}}</td>

     <td>
       <button type="button" class="btn btn-primary " data-toggle="modal" data-target={{'#'.$gtd->booking_id}}>
         <!-- <span class="glyphicon glyphicon-eye-open"></span> -->
         View
       </button>

       <!-- Modal HTML Markup -->

       <div id={{$gtd->booking_id}} class="modal fade">
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
                                  <input type="text" class="form-control input-lg" name="" value="{{$gtd->booking_id}}" readonly>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label">User_ID</label>
                              <div>
                                  <input type="text" class="form-control input-lg" name="" value="{{$gtd->user_id}}" readonly>
                              </div>
                          </div>



                          <div class="form-group">
                              <label class="control-label">Product_ID</label>
                              <div>
                                  <input type="text" class="form-control input-lg" name="" value="{{$gtd->product_id}}" readonly>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="control-label">Booking_Reason</label>
                              <div>
                                  <input type="text" class="form-control input-lg" name="" value="{{$gtd->booking_reason}}" readonly>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="control-label">Start_Date</label>
                              <div>
                                  <input type="text" class="form-control input-lg" name="" value="{{$gtd->start_date}}" readonly>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label">End_Date</label>
                              <div>
                                  <input type="text" class="form-control input-lg" name="" value="{{$gtd->end_date}}" readonly>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label">Comments</label>
                              <div>
                                  <input type="text" class="form-control input-lg" name="" value="{{$gtd->comment}}" readonly>
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
   @endif
 </tbody>
</table>

</div>
</div>

</br>




@endsection
