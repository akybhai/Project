@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User Information</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                     <h1>{{auth()->user()->name}}</h1>
                    <h3>Welcome to Inventory System</h3>
                    <h5>Your details.</h5>
                    <form method="POST" class="form-horizontal" action="{{route('home.post')}}" onsubmit="return(validate());" name="myForm">
                      {{ csrf_field() }}
                      <div class="form-group">
                        <label class="control-label col-sm-2" for="tel">Mobile No:</label>
                        <div class="col-sm-10">
                          <input type="tel" class="form-control" id="tel" placeholder="Enter Mobile no" name="tel"
                          value="<?php
                          use App\User;
                          $user = User::find(Auth::id());
                          if($user->mobile!=null)
                          {
                              echo $user->mobile;
                          }

                          ?>"
                          >
                        </div>

                      </div>
                      @if($user->mobile==null)
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <div class="col-sm-1"><input  type="checkbox" class="btn btn-primary" required> </input> </div><div class=" col-sm-11"> I understand that my data is used for SocsBox purpose only, and can be deleted on request to admin.</div>
                        </div>
                      </div>
                      @endif
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button  type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </form>

                    <span style="color:red">*As per Admin Rules, You need to have a valid phone number to book a product.</span>
                    {{-- form for storing the Values --}}

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    <!--
    // Form validation code will come here.
    function validate()
    {

        var phoneno = /^\d{10}$/;
        if((document.myForm.tel.value.match(phoneno)))
        {
            return true;
        }
        else
        {
            alert("Invalid Mobile Number, Enter Mobile Number(0XXXXXXXXX)");
            return false;
        }
    }

    //-->
</script>
@endsection

@section('script')
@endsection
