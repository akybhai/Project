@extends('staffadmin.layouts.app')

@section('admincontent')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-address-book-o"></i> User List</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{ route('home')}}">Dashboard</a></li>
        </ul>
    </div>
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
                  <th>Mobile No</th>
                  <!-- <th>Position</th> -->
                  <!-- <th>Society</th> -->
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
                    <td>{{$userlist->mobile}}</td>
                    <!-- <td>{{$userlist->post}}</td> -->
                    <!-- <td>{{$userlist->society}}</td> -->
                    <!-- <td>{{$userlist->role_id}}</td> -->
                    <td>
                    @if($userlist->role_id==1)
                       Admin
                    @elseif($userlist->role_id==2)
                       Staff
                    @else
                       User
                       @endif
                    </td>

                    @if($set)


                      <td>
                        @if($userlist->role_id==3 )
                        <form method="POST" action="{{ url('mak/stf/'.$userlist->id)}}" style="float:left;">

                  {{ csrf_field() }}
                  <button class="btn btn-info" type="submit" value="approve">Make Staff</button>
                </form>


                        <form method="POST" action="{{ url('del/usr/'.$userlist->id)}}" style="float:left;">

                  {{ csrf_field() }}
                  <button class="btn btn-danger" type="submit" value="approve">Delete User</button>
                </form>
                @endif
                @if($userlist->role_id==2 )


                <form method="POST" action="{{ url('del/usr/'.$userlist->id)}}" style="float:left;">

          {{ csrf_field() }}
          <button class="btn btn-danger" type="submit" value="approve">Delete Staff</button>
        </form>
        @endif
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
