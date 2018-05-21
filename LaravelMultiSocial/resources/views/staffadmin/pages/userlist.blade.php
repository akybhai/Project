@extends('staffadmin.layouts.app')

@section('admincontent')
<div class="container">
      <div class="row">

        <table class="table table-hover">
          <thead>
            <tr>
              <th>

        <legend> List of all Users</legend>
      </th>
      <th>
        <!-- <a href="/" class="btn btn-primary">Export to Excel</a> -->
        <!-- <button class="btn btn-primary btn-lg" type="button">Export Users List</button> -->
        <a href="/lo/go" class="btn btn-primary">Export Userlist</a>
      </th>
    </tr>
  </thead>
</table>
<?php
use App\User;
use Illuminate\Support\Facades\Auth;


$set=1;

$user = User::find(Auth::id());
  //$bookID = 1;
  //$collectData = DB::table('transactions')->where('booking_id', $bookID)->first();
//check if the user has admin role
if ($user->role_id == '2')
{
  $set=0;
}

?>



    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>

                  <th>UserId</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Position</th>
                  <th>Society</th>
                  <th>Role</th>
                  <?php
                  if($set)
                  {
                    echo '<th scope="col">Action</th>';
                  }

                  ?>


                </tr>
              </thead>
              <tbody>

@if(count($userlists)>0)
      @foreach($userlists as $userlist)

                <tr>


                    <td>{{$userlist->id}}</td>
                    <td>{{$userlist->name}}</td>
                    <td>{{$userlist->email}}</td>
                    <td>{{$userlist->post}}</td>
                    <td>{{$userlist->society}}</td>
                    <td>{{$userlist->role_id}}</td>

                    @if($set)

                    
                      <td>
                        <form method="POST" action="{{ url('mak/stf/'.$userlist->id)}}" style="float:left;">

                  {{ csrf_field() }}
                  <button class="btn btn-info" type="submit" value="approve">Make Staff</button>
                </form>


                        <form method="POST" action="{{ url('del/usr/'.$userlist->id)}}" style="float:left;">

                  {{ csrf_field() }}
                  <button class="btn btn-danger" type="submit" value="approve">Delete User</button>
                </form>
                      </td>


                  @endif


                   <!-- <td><label><input type="checkbox" value='{{$userlist->User_ID}}' name="checked[]">{$userlists as $userlist}</label></td> -->

              </tr>


@endforeach
     @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

       @endsection
