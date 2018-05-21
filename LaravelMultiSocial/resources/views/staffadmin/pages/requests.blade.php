@extends('staffadmin.layouts.app')

@section('admincontent')

<div class="container">
      <div class="row">

        <table class="table table-hover">
          <thead>
            <tr>

              <!-- <th scope="col"><legend><span><a href="{{url('/')}}">Pending</a></span></legend></th>
              <th scope="col"><legend><span><a href="{{url('/approved')}}">Approved</a></span></legend></th>
              <th scope="col"><legend><span><a href="{{url('/declined')}}">Declined</a></span></legend></th> -->
              <th scope="col"><legend><span><a href="{{ route('adminstaff.request')}}">Pending</a></span></legend></th>
              <th scope="col"><legend><span><a href="#" onclick="approvedfunction()">Approved</a></span></legend></th>
              <th scope="col"><legend><span><a href="#" onclick="declinedfunction()">Declined</a></span></legend></th>
            </tr>
          </thead>
          </table>
        </div>
      </div>
<div class="container" id="statusTables">
  <div class="row">
<legend> Pending Requests </legend>
        <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Transaction ID</th>
      <th scope="col">User ID</th>
      <th scope="col">Product ID</th>
      <th scope="col">Product Name</th>
      <th scope="col">Description</th>
      <th scope="col">Start Date</th>
      <th scope="col">End Date</th>
      <th scope="col">Status</th>

      <th scope="col">Action</th>

    </tr>
  </thead>
  <tbody>
    <!-- {{count($articles)}} -->
    @if(count($articles)>0)
      @foreach($articles as $article)

      <td> {{$article->booking_id}}</td>
      <td>{{$article->user_id}}</td>
      <td>{{$article->product_id}}</td>

      <td>temp</td>
      <td>{{$article->booking_reason}}</td>
      <td>{{$article->start_date}}</td>
      <td>{{$article->end_date}}</td>
      <td>{{$article->booking_status}}</td>



      <td>
        <!-- <a href="man({{ $article->id}})" class="btn btn-success"> Approve </a> -->
        <!-- <a href="{{url('')}}" class="btn btn-success"> Approve </a> -->
        <form method="POST" action="{{ url('apv/but/'.$article->booking_id)}}" style="float:right;">

              {{ csrf_field() }}
              <button class="btn btn-success" type="submit" value="approve">Approve</button>
            </form>
        <!-- <a href="{{url('')}}" class="btn btn-danger"> Decline </a> -->
        <!-- <form method="POST" action="{{ url('dec/but/'.$article->id)}}" style="float:right;"> -->

              <!-- {{ csrf_field() }} -->
              <!-- <button class="btn btn-danger" type="submit" value="decline">Decline</button> -->
            <!-- </form> -->

            <!-- <button type="button" class="btn btn-danger" data toggle="model" data-target="#modal1">Decline </button> -->
            <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Decline</button>

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
  </div>


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
