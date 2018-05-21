@extends('layouts.loginlayout')

@section('style')
  <!-- Bootstrap core CSS -->
<link href="sa/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom fonts for this template -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
<link href="sa/fonts/font-awesome.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="sa/css/coming-soon.css" rel="stylesheet">

@endsection

@section('content')
  <div class="overlay" style="height: 100%;"></div>
<div class="masthead" style="width:50%; height:80%">
<div class="masthead-bg" style="z-index:-1"></div>
<div class="container h-100" style="width:100%;height:100%">
<div class="row ha-100" style="width:100%;height:100%;margin:0px">
  <div class="col-12" style="margin-top: 30%">

  <div class="masthead-content text-white">
  <h1 style="font-weight: 700; font-size:60px"><font color="White">Please Login!</h1>
  <p style="font-weight: 200; font-size:20px">Use NUIG account
    <strong>Click button below</strong></p></font>
    <a href="{{route ('auth.microsoft')}}"><button class="btn btn-secondary btn-lg" type="button">Login Here</button></a>

</div>
</div>
</div>
</div>
</div>
@endsection

@section('script')
  <!-- Bootstrap core JavaScript -->
<script src="sa/jquery/jquery.min.js"></script>
<script src="sa/js/bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="sa/jquery/jquery.vide.min.js"></script>

<!-- Custom scripts for this template -->
<script src="sa/js/coming-soon.js"></script>
@endsection
